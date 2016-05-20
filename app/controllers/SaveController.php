<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 02.05.2016
 * Time: 22:36
 */

namespace app\Controllers;


use app\Models\Humans;
use app\Models\Tries;
use app\Models\TreeSettings;
use core\Controllers\Application;
use core\Controllers\Loader;
use core\Controllers\Session;
use vendor\Controllers\Request;


class SaveController extends Application{
    public function humansAction(){
        $model = new Humans();
        $model->tree_id = Session::get('tree_id');
        $model->fname = $_REQUEST['fname'];
        $model->lname = $_REQUEST['lname'];
        $model->mname = $_REQUEST['mname'];
        $model->sex = $_REQUEST['sex'];
        $model->bdate = $_REQUEST['bdate'];
        $model->ripdate = $_REQUEST['ripdate'];
        $model->description = $_REQUEST['description'];
        $model->coordinate = $_REQUEST['coordinate'];
        $model->insert();
        Loader::app()->route->redirect('/greed/');
    }

    public function menuAction(){
        $model = new TreeSettings();
        $params = json_decode($_REQUEST['json'],true);
        $conn = $model->db->pdo;
        $sql = "SELECT COUNT(*) FROM {$model->table} WHERE `tree_id`=".Session::get('tree_id');
        if ($res = $conn->query($sql)) {
            if ($res->fetchColumn() > 0) {
                $sql = "UPDATE {$model->table} SET `top`='{$params['top']}', `left`='{$params['left']}' WHERE `tree_id`=".Session::get('tree_id');
                $conn->query($sql);
            } else {
                $model->tree_id = Session::get('tree_id');
                $model->top = $params['top'];
                $model->left = $params['left'];
                $model->insert();
            }
        }
    }

    public function coordsAction(){
        $model = new Humans();

        foreach(json_decode($_REQUEST['json']) as $key=>$val){
            $model->validateKey = ['id'=>$val->id];
            $coords = "{$val->pos->top}|{$val->pos->left}";
            $model->queryUpdate($val->id, ['coordinate'=>$coords]);
        }
    }
    public function backgroundAction(){
        $model = new Tries();

        $model->validateKey = ['id'=>Session::get('tree_id')];
        $model->queryUpdate(Session::get('tree_id'), ['background_id'=>$_REQUEST['id']]);

    }
}