<?php
use core\Controllers\Session;
?>

<?php

if(Session::get('activeTree') == null){
    echo $this->partial('noTree');
}else{
    echo $this->partial('showTree');
}
?>
