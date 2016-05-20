/**
 */
var arrowsDrawer = $cArrows('#services');


$(document).ready(function(){
    $('.slideMenu').find('a').on('click', function(){
        var action = $(this).data('action');
        window[action].call();
    });
    $.post('/ajax/menu',{},function(data){
        var coords = JSON.parse(data);
        $('.slideMenu').css("top",coords[0].top);
        $('.slideMenu').css("left",coords[0].left);
    });
    $( ".humanContainer" ).draggable();
    $('.slideMenu > .title').click(function(){
        $('.slideMenu > .content').toggle('slow');
    });
    $(document).delegate('.humanContainer', 'mouseenter', function(){
        $(this).popover('show');
    });
    $(document).delegate('.humanContainer', 'mouseleave', function(){
        $(this).popover('hide');
    });
    $('a.menu').click(function(){
        var objectName = $(this).data('action');
        $('#'+objectName).modal({'show':true});

        var images = JSON.parse(backgrounds_json);
        $('#modalBackgroundContainer').html('');
        $(images).each(function(i,data){
            $('#modalBackgroundContainer').append('<div class="col-xs-6 col-md-3"><a href="#" class="thumbnail selectImageActive" data-id="'+data.id+'" data-img="'+data.link+'"><img src="/assets/img/tries/'+data.link+'" alt="Add this image to background"></a></div>');
        });
        return false;
    });
    $('.slideMenu').draggable();
    $("#services").on('click',function(){
        if($('.humanContainer').length == 0) {
            $('#addParent').modal({'show': true});
        }
    });
    $('body').on('click','#searchButton', function(){
        location.href ='/greed/load?tree='+$('#searchField').val();
    })
    $('body').on('click', 'a.selectImageActive',function(){
        var id = $(this).data('id');
        $('#services').css('background-image','url(/assets/img/tries/' + $(this).data('img')+')') ;
        $.post('/save/background/',{'id':id},function(data){});
    });
    $('body').on('mouseup','.humanContainer',function(){
        saveBlocksPosition();
        var id = $(this).attr('data-id');

        arrowsDrawer.redraw();
    });
    $('body').on('mouseup','.slideMenu',function(){
        saveSettingsPosition();
    });
    $('.saveTreeView').on('click',function(){
        saveBlocksPosition();
    });
    $(".pop").popover({ trigger: "manual" , html: true, animation:false}).on("mouseenter", function () {
            var _this = this;
            $(this).popover("show");
            $(".popover").on("mouseleave", function () {
                $(_this).popover('hide');
            });
        }).on("mouseleave", function () {
            var _this = this;
            setTimeout(function () {
                if (!$(".popover:hover").length) {
                    $(_this).popover("hide");
                }
            }, 300);
    });
});
