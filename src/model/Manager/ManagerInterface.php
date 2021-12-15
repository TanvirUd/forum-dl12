<?php
namespace App\Manager;

interface ManagerInterface
{
    public function __construct();

    public function findAll();

    public function findOneById($id);
}