<?php
namespace App\Manager;

class CommentManager extends AbstractManager implements ManagerInterface
{
    public function __construct()
    {
        parent::connect();
    }

    public function findAll()
    {
        return $this::getResults(
            "App\\Entity\\Comment",
            "SELECT * FROM comment"
        );
    }

    public function findOneById($id)
    {
        return $this::getOneOrNullResult(
            "App\\Entity\\Comment",
            "SELECT * FROM comment WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

    public function findCommentByPost($id)
    {
        return $this::getResults(
            "App\\Entity\\Comment",
            "SELECT * FROM comment
            WHERE comment.post_id = :p",
            [
                ":p" => $id
            ]
        );
    }

    public function findCommentByUser($id)
    {
        return $this::getResults(
            "App\\Entity\\Comment",
            "SELECT * FROM comment
            WHERE comment.user_id = :u",
            [
                ":u" => $id
            ]
        );
    }

    public function insertComment($comment, $post_id, $user_id)
    {
        $this::executeQuery(
            "INSERT INTO comment (content, post_id, user_id) 
            VALUES (:c, :p, :u)",
            [
                ":c" => $comment,
                ":p" => $post_id,
                ":u" => $user_id
            ]
        );
        return $this::getLastInsertId();
    }

    public function updatePost($id, $comment)
    {
        return $this::executeQuery(
            "UPDATE comment 
            SET content = :c
            WHERE id = :id",
            [
                ":id" => $id,
                ":n"  => $comment                
            ]
        );
    }

    public function deletePost($id){
        return $this::executeQuery(
            "DELETE FROM comment WHERE id = :id",
            [
                ':id' => $id 
            ]
        );
    }

}

?>