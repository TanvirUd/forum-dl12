<?php
namespace App\Controller;

use App\Manager\CategoryManager;
use App\Manager\TopicManager;

class CategoryController extends AbstractController
{
    public function allCategory()
    {
        $cmanager = new CategoryManager;
        $pmanager = new TopicManager;
        $category = $cmanager->findAll();
        foreach($category as $cat){
            $topic[] = $pmanager->findTopicByCategory($cat->getId());
        }        
        return $this->render("forum/category.php", [
            "category" => $category,
            "topic" => $topic
        ]);
    }

    public function categoryByPost($id)
    {
        $cmanager = new CategoryManager;
        $category = $cmanager->findOneById($id);
        
        return $this->render("forum/category.php", [
            "category" => $category
        ]);
    }
}