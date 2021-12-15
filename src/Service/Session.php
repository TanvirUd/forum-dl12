<?php
namespace App\Service;

abstract class Session
{
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
        return $_SESSION[$key];
    }

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public static function get($key)
    {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return null;
    }

}