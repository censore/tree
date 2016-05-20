<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 02.05.2016
 * Time: 22:40
 */

namespace vendor\Controllers;

use core\interfaces\ConfigGroupInterface;
use core\traits\GetSetRunImplementation;
use vendor\Components\singletonComponent;

class Request extends singletonComponent{
    public $type = 'GET';
    public $requestArray;
    public function get($param){
        $this->getParams();
        if(isset($this->requestArray[$param])){
            return $this->validate($this->requestArray[$param]);
        }else{
            return false;
        }
    }

    public function getAll(){
        $this->getParams();
        return $this->requestArray;
    }

    public function validate($val){
        return strip_tags(htmlspecialchars($val));
    }

    private function getParams(){
        if($this->requestArray !== null) return $this->requestArray;
        $type = '_'.$this->requestType();
        $this->requestArray = $$type;
    }
    public function requestType(){
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $this->type = strtoupper($_SERVER['REQUEST_METHOD']);
            return $this->type;
        }
        return 'GET';
    }


}