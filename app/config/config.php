<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 0:19
 */

return [
    'app' => [
        'assets'=>[
            'top'=>[
                'application-startup.css',
                'toolkit-startup.css',
                'https://fonts.googleapis.com/css?family=Lora:400,400italic|Work+Sans:300,400,500,600'=>'remote'
            ],
            'bottom'=>[],
        ],
    ],
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
        'view' => 'app/views',
        'layout' => 'main',
    ],
];