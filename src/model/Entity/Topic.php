<?php
namespace App\Entity;

class Topic extends AbstractEntity
{
    private $id;
    private $name_topic;
    protected $category;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name_topic;
    }

    public function getCategory()
    {
        return $this->category;
    }
}