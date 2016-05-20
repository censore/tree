<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 08.05.2016
 * Time: 18:06
 */

namespace app\Controllers;

use app\Models\Relate;
use app\Models\TreeSettings;
use core\Controllers\Application;
use core\Controllers\Session;

class AjaxController extends Application{
    public $data;
    public function returnData(){
        die(json_encode($this->data));
    }
    public function relateAction(){
        $peoples = $_REQUEST['humans'];
        $humans = new Relate();
        $data = [];
        foreach($peoples as $human){
            $humans->validateKey = ['human_id'=>$human];
            $data[] = $humans->findAll();
        }
        $this->data = $data;
        $this->returnData();
    }
    public function menuAction(){
        $model = new TreeSettings();
        $model->validateKey = ['tree_id'=>Session::get('tree_id')];
        $this->data = $model->findAll();
        $this->returnData();
    }
}