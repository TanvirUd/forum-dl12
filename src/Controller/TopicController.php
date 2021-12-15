<?php
namespace App\Controller;

use App\Entity\Category;
use App\Manager\CategoryManager;
use App\Manager\UserManager;
use App\Service\Form;
use App\Service\Session;

use App\Manager\TopicManager;

class TopicController extends AbstractController
{
    public function index()
    {
        $tmanager = new TopicManager();
        $cmanager = new CategoryManager();
        $topics = $tmanager->findAll();
        $category = $cmanager->findAll();
        return $this->render("forum/home.php", [
            "topic" => $topics,
            "category" => $category
        ]);
    }

    public function topic($id)
    {
        $tmanager = new TopicManager();
        $topics = $tmanager->findOneById($id);

        if(!$topics) return false;

        return $this->render("forum/home.php", [
            "topic" => $topics
        ]);
    }

    public function AllTopicByCategory($id)
    {
        $tmanager = new TopicManager();
        $cmanager = new CategoryManager();
        $category = $cmanager->findAll();
        $topics = $tmanager->findTopicByCategory($id);

        if(!$topics) return false;

        return $this->render("forum/home.php", [
            "topic" => $topics,
            "category" => $category
        ]);
    }

    public function insertTopicByUser()
    {
        if(Form::isSubmitted()){
            $userBd = new UserManager();
            $topic = Form::getData("topic", "text");
            $category = Form::getData("category", "int");
            $user = Session::get("user");
            $compatator = $userBd->findByUsernameOrEmail($user->getUsername(), $user->getEmail());
            if($topic && $category && $user){
                $tmanager = new TopicManager();
                $tmanager->insertTopic($topic, $category, $compatator->getId());
            } else $this->addFlash("error", "Something went wrong");
        }
        return $this->index();   
    }

    public function userTopic($id)
    {
        $tmanager = new TopicManager();
        $topics = $tmanager->findAllByUser($id);

        if(!$topics) return false;

        return $this->render("forum/home.php", [
            "topic" => $topics
        ]);
    }
}
