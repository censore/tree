<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 3:15
 */

namespace app\Controllers;

use core\Controllers\Loader;
use app\Models\Blocks;
use core\Controllers\Application;
use core\Controllers\Loader as app;

class IndexController extends Application{
    public function indexAction(){
        $this->view->currentView('index',[]);
    }
}