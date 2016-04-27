<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 3:00
 */

namespace core\Controllers;

use core\Controllers\Session;
use core\interfaces\ApplicationInterface;

class Application implements ApplicationInterface{
    public $defaultAction;
    public $controller;
    public $method;
    public function runMethod($method = null){
        Session::init();
        Loader::app()->leazyLoader('view');
        if($this->defaultAction !== null && $method !==null){
            $method = $this->defaultAction;
        }

        $method = strtolower($method) . 'Action';
        if(method_exists($this,$method)){

            $this->$method();
        }
    }
}