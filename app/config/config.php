<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 0:19
 */

return [
    'depends'=>[
        'db' => [
            'class' => 'core\\components\\db\\Db',
            'method' => 'Connect',
            'params' => [
                'dbname' => 'family',
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'charset' => 'SET NAMES utf8',
            ],
        ],
    ],
    'route' => [
        'controller' => 'c',
        'method' => 'm',
        'app_directory' => '\app\Controllers\\',
    ],
    'system' => [
        'view_path' => 'app.views'
    ],
];