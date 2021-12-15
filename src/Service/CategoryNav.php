<?php
namespace App\Service;
use App\Manager\CategoryManager;

abstract class CategoryNav{

    public static function get(){
        $cmanager = new CategoryManager;
        return $cmanager->findAll();
    }
}