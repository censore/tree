<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 22:44
 */

namespace vendor\Controllers;

use core\interfaces\ConfigGroupInterface;
use core\traits\GetSetRunImplementation;

class Template extends GetSetRunImplementation implements ConfigGroupInterface{
    public function partial($file, $properties){
        extract($properties);
        ob_start();
        require_once '';
        $content = ob_get_contents();
        ob_end_flush();
        ob_clean();
        return $content;
    }
    public function render($file, $properties){

    }
    public function view(){

    }
}