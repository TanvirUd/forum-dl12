<?php
namespace App\Controller;

use App\Entity\Category;
use App\Service\Form;
use App\Manager\CategoryManager;
use App\Manager\TopicManager;
use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\UserManager;

class AdminController extends AbstractController
{
    public function index()
    {
        if(!$this->isGranted("ROLE_ADMIN")) return false;

        $cmanager = new CategoryManager();
        $tmanager = new TopicManager();
        $pmanager = new PostManager();
        $comanager = new CommentManager();
        $umanager = new UserManager();
        
        $topics = $tmanager->findAll();
        $categories = $cmanager->findAll();
        $comments = $comanager->findAll();
        $posts = $pmanager->findAll();
        $users = $umanager->findAll();

        return $this->render("admin/home.php", [
            "topics"   => $topics,
            "categories" => $categories,
            "posts" => $posts,
            "comments" => $comments,
            "user" => $users
        ]);
    }
}