<?php
require_once dirname(__FILE__).'/vendor/autoload.php';
$config = require_once(dirname(__FILE__) . '/app/config/config.php');

use core\Controllers\Loader;
$app = Loader::init();
$app->run($config);
