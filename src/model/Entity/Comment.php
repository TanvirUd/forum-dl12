<?php
namespace App\Entity;

class Comment extends AbstractEntity
{
    private $id;
    private $content;
    protected $user;
    protected $post;

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

    public function getUser()
    {
        return $this->user;
    }

    public function getPost()
    {
        return $this->post;
    }
}