<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\TopicManager;
use App\Manager\UserManager;
use App\Service\Form;
use App\Service\Session;

class PostController extends AbstractController
{
    public function allPost(){
        $pmanager = new PostManager();
        $post = $pmanager->findAll();

        return $this->render("forum/post.php", [
            "post" => $post
        ]);
    }

    public function allPostByTopic($id)
    {
        $pmanager = new PostManager();
        $cmanager = new CommentManager();
        $tmanager = new TopicManager();
        $topic = $tmanager->findOneById($id);
        $post = $pmanager->findPostByTopic($id);
        foreach($post as $p) {
            $comments[] = $cmanager->findCommentByPost($p->getId());
        }

        $comments = isset($comments) ? $comments : null;

        return $this->render("forum/post.php", [
            "post" => $post,
            "comments" => $comments,
            "topic" => $topic
        ]);
        
    }

    public function allPostByUser($id)
    {
        $pmanager = new PostManager();
        $post = $pmanager->findPostByUser($id);

        return $this->render("forum/post.php", [
            "post" => $post
        ]);
    }

    public function insertPostByUser($id)
    {
        if(Form::isSubmitted()){
            $userBd = new UserManager();
            $post = Form::getData("post", "text");
            $user = Session::get("user");
            $compatator = $userBd->findByUsernameOrEmail($user->getUsername(), $user->getEmail());
            if($post && $user){
                $tmanager = new PostManager();
                $tmanager->insertPost($post, $id, $compatator->getId());
            } else $this->addFlash("error", "Something went wrong");
        }
        return $this->allPostByTopic($id); 
    }

    public function specificPost($id)
    {
        $pmanager = new PostManager();
        $post = $pmanager->findOneById($id);

        return $this->render("forum/post.php", [
            "post" => $post
        ]);
    }
    
}
