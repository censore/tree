function getAge(dateString){
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate()))
    {
        age--;
    }
    return age;
}
function getLastAgeDate(birthDate, activeDate){
    if(activeDate == null){
        return '('+getAge(birthDate)+')';
    }else{
        return activeDate + '('+getAge(birthDate)+')';
    }
}
function buildTree(humans_json){
    if(humans_json!==undefined){
        localStorage.clear();
        $(JSON.parse(humans_json)).each(function(i,item){
            localStorage.setItem('item_'+item.id,  item.fname + ' ' + item.lname);
            var html = _.template(container)({
                id: item.id,
                lname: item.lname,
                fname: item.fname,
                photo: item.photo,
                bdate: item.bdate,
                ripdate: getLastAgeDate(item.bdate, item.ripdate),
                sex: item.sex,
                description: item.description
            });

            $('#services').append(html);
            var coords = item.coordinate.split('|');
            $('#container_'+ item.id).css("position","absolute");
            $('#container_'+ item.id).css("left",coords[1]+'px');
            $('#container_'+ item.id).css("top",coords[0]+'px');

        });
        $( ".humanContainer" ).draggable();
        $( "#newContainer" ).draggable();

        $('.humanContainer').each(function(idx,content){
            var id = $(this).attr('data-id');
            $.post('/ajax/relate',{'humans[]':id},function(data){
                var json = JSON.parse(data);
                var arrows = [];
                var counter = 0;
                $(json).each(function(i,v){
                    if(v[0] && v[0].relate_to !== undefined){
                        try{
                            arrows[counter] = ['#container_'+ v[0].human_id,  '#container_'+ v[0].relate_to];
                            counter ++;
                        }catch (err){
                        }
                    }else{
                    }
                });
                if(counter > 0){
                    arrowsDrawer.arrows(arrows);
                }
            });
        });
    }
}
function str_replace ( search, replace, subject ) {

    if(!(replace instanceof Array)){
        replace=new Array(replace);
        if(search instanceof Array){//If search	is an array and replace	is a string, then this replacement string is used for every value of search
            while(search.length>replace.length){
                replace[replace.length]=replace[0];
            }
        }
    }

    if(!(search instanceof Array))search=new Array(search);
    while(search.length>replace.length){//If replace	has fewer values than search , then an empty string is used for the rest of replacement values
        replace[replace.length]='';
    }

    if(subject instanceof Array){//If subject is an array, then the search and replace is performed with every entry of subject , and the return value is an array as well.
        for(k in subject){
            subject[k]=str_replace(search,replace,subject[k]);
        }
        return subject;
    }

    for(var k=0; k<search.length; k++){
        var i = subject.indexOf(search[k]);
        while(i>-1){
            subject = subject.replace(search[k], replace[k]);
            i = subject.indexOf(search[k],i);
        }
    }

    return subject;

}
function addRelate(){
    $('#addRelate').modal({'show': true});

    $.each(localStorage, function(key, item){
        var isItem = key.split('_');
        if(isItem[0] == 'item'){

            $('#modalRelateFrom').append($('<option>', {
                value: isItem[1],
                text : item
            }));
        }
    });
    $('#modalRelateFrom').attr('class',"selectpicker");
    $('#modalRelateFrom').attr('data-live-search',"true");
    

}
function saveSettingsPosition(){
    var menu = $('.slideMenu').position();
    $.post('/save/menu',{'json':JSON.stringify(menu)},function(data){
    });
}
function saveBlocksPosition(){
    var cart = [];
    $('.humanContainer').each(function(){
        var element = {};
        var id = $(this).attr('data-id');
        var pos = $(this).position();
        element.id = id;
        element.pos = pos;
        cart.push(element);
    });

    $.post('/save/coords',{'json':JSON.stringify(cart)},function(data){
    });
}