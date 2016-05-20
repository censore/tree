<!--  Add relationship form //-->
<div class="modal fade" id="addRelate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Create relationship</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline">
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail3">Relate From</label>
                        <select id="modalRelateFrom">
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword3">Relate To</label>
                        <select class="selectpicker" data-live-search="true" id="modalRelateTo">
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Create</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>