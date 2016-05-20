<?php
use core\Controllers\Loader;
?>
<!-- Modal -->
<div class="modal fade" id="flashModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header <?=Loader::app()->flashType?>">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Information!</h4>
            </div>
            <div class="modal-body">
                <?=Loader::app()->flashContent?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#flashModal').modal({'show':true});
    });
</script>