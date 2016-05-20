<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 01.05.2016
 * Time: 3:33
 */
namespace app\Controllers;

use app\Components\createComponent;

use app\Models\Backgrounds;
use app\Models\Blocks;
use app\Models\Humans;
use app\Models\Sexes;
use app\Models\Tries;
use core\Controllers\Application;
use core\Controllers\Session;
use core\Controllers\Loader;
use core\Controllers\Route;

class TreeController extends Application{
    public function indexAction(){
        $session = Session::get('tree_id');

        if($session == null){
            $component = new createComponent();
            $model = $component->createNew();
            Session::set('treeKey', $model->link);
            Session::set('tree_id', $model->id);
        }else{
            $model = new Tries();
            $model->validateKey = ['id'=>$session];
            $model->find();
        }
        $blocks = new Blocks();
        $sex = new Sexes();
        $backgrounds = new Backgrounds();
        $humans = new Humans();

        $this->view->currentView('index', [
            'model'=>$model,
            'blocks'=>$blocks,
            'backgrounds'=>$backgrounds,
            'sex'=>$sex,
            'humans'=>$humans,
        ]);
    }

    public function loadAction(){
        $tree = null;
        if(isset($_REQUEST['tree']) ){
            $tree = $_REQUEST['tree'];
        }

        if($tree == null){
            Loader::app()->flash("Tree didn't found!");
            Route::redirect('/greed/');
        }
    }
}