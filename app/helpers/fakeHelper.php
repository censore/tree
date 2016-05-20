<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 01.05.2016
 * Time: 4:05
 */

namespace app\Helpers;


class fakeHelper {
    public static function randomString($min = 5, $max = 10){
        $string = [];
        $counter = mt_rand($min, $max);
        $string[] = $counter;
        for($i=0; $i<$counter; $i++){
            $upper = (mt_rand(0,1));

            if($upper == "1"){
                $string[] = chr(mt_rand(65,90));
            }else{
                $string[] = strtolower(chr(mt_rand(65,90)));
            }
        }
        return implode('',$string);
    }
}