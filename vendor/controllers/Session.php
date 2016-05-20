<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 27.04.2016
 * Time: 21:17
 */

namespace core\Controllers;


abstract class Session {
    public static function get($key){
        self::checkSession();
        $val = (!$_SESSION || !isset($_SESSION[$key]) ?null:$_SESSION[$key]);
        return $val;
    }

    public static function set($key, $val){
        self::checkSession();

        $_SESSION[$key] = $val;
        return true;
    }

    public static function init(){
        session_start();
        $_SESSION='';
    }

    public static function kill($key){
        self::checkSession();
        if(!isset($_SESSION[$key])) return null;

        unset($_SESSION[$key]);
    }

    public static function id(){
        self::checkSession();
        return session_id();
    }
    public static function destroy(){
        self::checkSession();
        $_SESSION = [];
        session_write_close();
        session_destroy();
    }
    public static function checkSession(){
        if (session_id() == '') {
           self::init();
        }
    }
}