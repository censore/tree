<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 2:33
 */

namespace core\traits;

use core\Controllers\Controller;

class GetSetRunImplementation {
    public $config = [];
    public $core;
    public function getConfig(){
        return $this->config;
    }
    public function setConfig(array $config, Controller $instance){
        $this->config = $config;
        $this->core = $instance;
    }
    public function init(){

    }
}