<?php
namespace App\Manager;

class TopicManager extends AbstractManager implements ManagerInterface
{
    public function __construct()
    {
        parent::connect();
    }

    public function findAll()
    {
        return $this::getResults(
            "App\\Entity\\Topic",
            "SELECT * FROM topic"
        );
    }

    public function findOneById($id)
    {
        return $this::getOneOrNullResult(
            "App\\Entity\\Topic",
            "SELECT * FROM topic WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

    public function findTopicByCategory($id)
    {
        return $this::getResults(
            "App\\Entity\\Topic",
            "SELECT * FROM topic WHERE category_id = :id",
            [
                ":id" => $id
            ]
        );
    }

    public function findAllByUser($user_id)
    {
        return $this::getResults(
            "App\\Entity\\Topic",
            "SELECT * FROM created_topic
            INNER JOIN topic ON created_topic.topic_id = topic.id
            INNER JOIN user ON created_topic.user_id = user.id
            WHERE created_topic.user_id = :u",
            [
                ":u" => $user_id
            ]
        );
    }

    public function insertTopic($topic, $category, $user)
    {
        $this::executeQuery(
            "INSERT INTO topic (name_topic, category_id) 
            VALUES (:n, :c)",
            [
                ":n" => $topic,
                ":c" => $category                            
            ]
        );
        $this::executeQuery(
            "INSERT INTO created_topic (user_id, topic_id)
            VALUES (:u, (SELECT MAX(id) FROM topic))",
            [
                ":u" => $user  
            ]
        );
        return $this::getLastInsertId();
    }

    public function updateTopic($id, $topic)
    {
        return $this::executeQuery(
            "UPDATE topic 
            SET name_topic = :n
            WHERE id = :id",
            [
                ":id" => $id,
                ":n"  => $topic                
            ]
        );
    }

    public function deleteTopic($id){
        return $this::executeQuery(
            "DELETE FROM topic WHERE id = :id",
            [
                ':id' => $id 
            ]
        );
    }

}