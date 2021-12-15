<?php
namespace App\Entity;

class Post extends AbstractEntity
{
    private $id;
    private $content;
    protected $topic;
    protected $user;

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
    public function getContent()
    {
        return $this->content;
    }

    public function getTopic()
    {
        return $this->topic;
    }

    public function getUser()
    {
        return $this->user;
    }
}