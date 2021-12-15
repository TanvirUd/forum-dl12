<?php
namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Service\Form;
use App\Service\Session;

class CommentController extends AbstractController
{
    public function allComments()
    {
        $cmanager = new CommentManager;
        $comments = $cmanager->findAll();
        
        return $this->render("forum/comment.php", [
            "comments" => $comments
        ]);
    }

    public function allCommentsByPost($id)
    {
        $cmanager = new CommentManager;
        $pmanager = new PostManager;
        $comments = $cmanager->findCommentByPost($id);
        $post = $pmanager->findOneById($id);
        return $this->render("forum/comment.php", [
            "comments" => $comments,
            "post" => $post
        ]);
    }

    public function insertCommentByUser($id)
    {
        if(Form::isSubmitted()){
            $userBd = new UserManager();
            $comment = Form::getData("comment", "text");
            $user = Session::get("user");
            $compatator = $userBd->findByUsernameOrEmail($user->getUsername(), $user->getEmail());
            if($comment && $user){
                $cmanager = new CommentManager();
                $cmanager->insertComment($comment, $id, $compatator->getId());
            } else $this->addFlash("error", "Something went wrong");
        }
        return $this->allCommentsByPost($id); 
    }

    public function allCommentsByUser($id)
    {
        $cmanager = new CommentManager;
        $comments = $cmanager->findCommentByUser($id);
        
        return $this->render("forum/comment.php", [
            "comments" => $comments
        ]);
    }
}