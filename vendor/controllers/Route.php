<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 2:28
 */

namespace core\Controllers;

use core\interfaces\ConfigGroupInterface;
use core\traits\GetSetRunImplementation;

class Route extends GetSetRunImplementation implements ConfigGroupInterface{
    public $defaultMethod = 'index';
    public $defaultController = 'index';
    public $actionPrefix = 'Action';
    public $runClss;
    public $runMethod;
    public function init(){
        parent::init();

    }
    public function startSite(){

        $controller = (isset($this->config['controller'])? $this->config['controller'] : 'c');
        $method = (isset($this->config['method'])? $this->config['method'] : 'm');

        $callClass =$this->config['app_directory'] .  ucfirst($this->defaultController) . 'Controller';

        if(isset($_REQUEST[$controller])){
            $class = $this->config['app_directory'] .  ucfirst($_REQUEST[$controller]) . 'Controller';
            if(class_exists($class)){
                $this->defaultController = $_REQUEST[$controller];
                $callClass = $class;
            }else{
                Loader::app()->flash('404 - Requested path not found!' . $class);
            }
        }

        $method = (isset($_REQUEST[$method])?$_REQUEST[$method]:$this->defaultMethod);

        $this->runClss = $callClass;
        $this->runMethod = $method;
        return $this;
    }
    public function changeQueryType(){
        if(isset($_REQUEST['format']) && $_REQUEST['format'] == 'json') Loader::app()->requestType = 'json';
    }
    public function redirect($path){
        header("location: {$path}",null, 302);
    }

}