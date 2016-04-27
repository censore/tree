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
        $value = explode(' ', $value);
        $type = '';
        $len = null;
        switch($value[0]){
            case "int":
            case "integer":
            case "varchar":
                $len = self::removeSkobka($value[1]);
                $type = ($value == 'int' || $value == 'integer'?'integer':'string');
            break;
            default:
                $type = 'string';
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