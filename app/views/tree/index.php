<?php
use core\Controllers\Loader;
?>

<?=$this->partial('showTree', [
    'model'=>$model,
    'blocks'=>$blocks,
    'backgrounds'=>$backgrounds,
    'sex'=>$sex,
    'humans'=>$humans,
]);?>

<script src="/assets/js/bootstrap-select.min.js"></script>

