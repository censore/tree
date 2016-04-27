<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 1:01
 */
namespace core\interfaces;

use core\Controllers\Controller;

interface ConfigGroupInterface{
    public function setConfig(array $config, Controller $instance);
    public function getConfig();
    public function init();
}