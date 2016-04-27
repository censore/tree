<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 22.04.2016
 * Time: 0:37
 */

namespace core\Controllers;

class Loader extends Controller {
    private static $_instance;
    public $application;

    public function init(){
        if(self::$_instance === null) self::$_instance = new self();
        return self::$_instance;
    }
    public function app(){
        return self::$_instance;
    }
}