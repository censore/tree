<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 21:50
 */

namespace app\helpers;


abstract class getTypeHelper {
    public static function int($value){

    }
    public static function getType($value){
        $value = str_replace(['(','{','[',')', '}',']'], ' ', $value);
        $value = explode(' ', $value);
        $type = '';
        $len = null;
        switch($value[0]){
            case "int":
            case "integer":
                $len = $value[1];
                $type = 'text';
            break;
            case "varchar":
                $len = $value[1];
                $type = 'text';
                break;
            case "text":
                $type = 'textarea';
                break;
            case "date":
            case "timestump":
                $type = "date";
            default:
                $type = $value[0];
        }
        return [
            $type,
            $len,
        ];
    }
    public static function removeSkobka($value){
        return str_replace(['(',')'],'',$value);
    }
}