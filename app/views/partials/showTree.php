<?php
use app\Helpers\exportHelper;
use app\Helpers\htmlHelper;
use core\Controllers\Session;
?>
<?=$this->partial('addRelate',[])?>
<?=$this->partial('addParent',['humans'=>$humans])?>
<?=$this->partial('background',[])?>

<?=$this->partial('slidemenu',[])?>

<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center tree">

            </div>
        </div>
    </div>
</section>
<script>
    <?=exportHelper::exportList($backgrounds)?>
</script>
<script src="/assets/js/main.js" ></script>
<script>

    $(document).ready(function(){
        <?=exportHelper::export($model,'attributes', 'tree_')?>

        <?=exportHelper::exportWithInstance($blocks, ['id'=>$model->block_style_id])?>

        <?=exportHelper::exportList($sex, ['id'=>$model->block_style_id])?>
        if(tree_background_id == 0){
            $('#services').css('backgroundImage','url(/assets/img/greed-bg.png)');
        }else{

            $(JSON.parse(backgrounds_json)).each(function(i, v){
                if(v.id == tree_background_id){
                    $('#services').css('backgroundImage','url(/assets/img/tries/'+ v.link+')');
                }
            });
        }
        buildTree('<?=exportHelper::exportListContainer($humans, ['tree_id'=>Session::get('tree_id')], true)?>');



    });
</script>
