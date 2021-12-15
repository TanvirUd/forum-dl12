<?php
namespace App\Entity;

class User extends AbstractEntity
{
    private $id;
    private $username;
    private $email;
    private $created_at;
    private $role;
    private $password;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAt($format = "d/m/Y H:i:s")
    {
        return $this::formatDate($this->created_at, $format);
    }
}