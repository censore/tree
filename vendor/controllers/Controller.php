<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 22.04.2016
 * Time: 0:41
 */

namespace core\Controllers;

class Controller extends Config{
    public $defaultAction = 'index';
    public $_config = [];
    public $fasades = [];
    public $activeClass;
    public $activeMethod;
    public function __construct(){}
    public function __clone(){}
    public function __copy(){}
    public function run(array $config){
        $this->_config = $config;
        parent::load();
        $site = $this->fasades['route']->startSite();
        $callClass = $site->runClss;
        $this->activeMethod = $site->runMethod;
        $siteInstance = new $callClass();
        $siteInstance->runMethod($this->activeMethod);
        return $this;
    }

    public function __get($property){

        if(!isset($this->fasades[$property])){
            $this->leazyLoader($property);
        }
        return $this->fasades[$property];
    }
    public function __set($key, $value){
        $this->fasades[$key] = $value;
        return $this;
    }
    public function leazyLoader($property){
        $property = 'core\\Controllers\\' . ucfirst(strtolower($property));

        if(!isset($this->fasades[$property])){
            $this->fasades[$property] = new $property();
        }

        return $this->fasades[$property];
    }
    public function getFasadeList(){
        return $this->fasades;
    }

}