<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 0:54
 */

namespace core\Controllers;


use core\interfaces\ConfigGroupInterface;
use core\traits\GetSetRunImplementation;

class Depends extends GetSetRunImplementation implements ConfigGroupInterface{

    public function init(){
        parent::init();
        foreach($this->config as $name => $data){
            if(isset($data['class'])){
                $this->core->$name = new $data['class']();
                if(isset($data['params']) && is_array($data['params'])){
                    foreach($data['params'] as $param => $value){
                        $this->core->$name->$param = $value;
                    }
                }
                if(isset($data['method'])){
                    $this->core->$name->$data['method']();
                }
            }
        }
    }
    public function leazyLoader(){

    }
}