<?php
namespace App\Manager;

class PostManager extends AbstractManager implements ManagerInterface
{
    public function __construct()
    {
        parent::connect();
    }

    public function findAll()
    {
        return $this::getResults(
            "App\\Entity\\Post",
            "SELECT * FROM post"
        );
    }

    public function findOneById($id)
    {
        return $this::getOneOrNullResult(
            "App\\Entity\\Post",
            "SELECT * FROM post WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

    public function findPostByTopic($id)
    {
        return $this::getResults(
            "App\\Entity\\Post",
            "SELECT * FROM post
            WHERE post.topic_id = :t",
            [
                ":t" => $id
            ]
        );
    }

    public function findPostByUser($id)
    {
        return $this::getResults(
            "App\\Entity\\Post",
            "SELECT * FROM post
            WHERE post.topic_id = :u",
            [
                ":u" => $id
            ]
        );
    }

    public function insertPost($post, $topic_id, $user_id)
    {
        $this::executeQuery(
            "INSERT INTO post (content, topic_id, user_id) 
            VALUES (:c, :t, :u)",
            [
                ":c" => $post,
                ":t" => $topic_id,
                ":u" => $user_id
            ]
        );
        return $this::getLastInsertId();
    }

    public function updatePost($id, $post)
    {
        return $this::executeQuery(
            "UPDATE post 
            SET content = :c
            WHERE id = :id",
            [
                ":id" => $id,
                ":n"  => $post                
            ]
        );
    }

    public function deletePost($id){
        return $this::executeQuery(
            "DELETE FROM post WHERE id = :id",
            [
                ':id' => $id 
            ]
        );
    }

}

?>