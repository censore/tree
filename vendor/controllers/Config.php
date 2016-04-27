<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 0:54
 */

namespace core\Controllers;

use core\interfaces;
use core\interfaces\ConfigGroupInterface;

class Config {
    public function load(){
        foreach($this->_config as $key => $val){
            $class = 'core\Controllers\\' . ucfirst($key);

            if(class_exists($class)){
                $instance = new $class();
                if($instance instanceof ConfigGroupInterface){
                    $instance->setConfig($val,$this);
                    $instance->init();
                    $this->__set($key, $instance);
                }
            }
        }
        return $this;
    }
}