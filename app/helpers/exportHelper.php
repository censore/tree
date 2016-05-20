<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 01.05.2016
 * Time: 11:28
 */

namespace app\Helpers;


class exportHelper {
    public static function export($object,$key, $prefix=''){
        if(is_array($object->$key)){
            foreach($object->$key as $i=>$val){
                echo  'var ', $prefix, $i , '=' , (is_numeric($val)?$val:"'{$val}';") . PHP_EOL;
            }
        }
    }
    public static function exportWithInstance($model, $find = []){
        $model->validateKey = $find;
        $model->findAll();
        self::export($model, 'attributes', $model->table . '_');
    }

    public static function exportList($model, $find = []){
        self::exportListContainer($model, $find);
    }

    public static function exportListContainer($model, $find = [], $return = false){
        $model->validateKey = $find;
        $res = $model->findAll();
        if($return == false){
            echo 'var '.$model->table . "_json ='".json_encode($res)."';";
            return;
        }else{
            return json_encode($res);
        }
    }
}