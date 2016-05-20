<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 02.05.2016
 * Time: 22:53
 */

namespace vendor\Components;


abstract class singletonComponent {

    protected function __construct() {}


    final public static function load()
    {
        static $instances = array();

        $calledClass = get_called_class();

        if (!isset($instances[$calledClass]))
        {
            $instances[$calledClass] = new $calledClass();
        }

        return $instances[$calledClass];
    }

    final private function __clone() {}

}