<?php
namespace App\Manager;

class CategoryManager extends AbstractManager implements ManagerInterface
{
    public function __construct()
    {
        parent::connect();
    }
    /**
     * Retourne tous les catégories de la base de données
     * 
     * @return array|false 
     * Renvoie un tableau contenant les produits sous forme de tableau, 
     * un tableau vide si aucun produit n'est présent en base
     * ou FALSE si la requète a échoué
     */
    public function findAll()
    {
        return $this::getResults(
            "App\\Entity\\Category",
            "SELECT * FROM category"
        );
    }

    public function findOneById($id)
    {
        return $this::getOneOrNullResult(
            "App\\Entity\\Category",
            "SELECT * FROM category WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }
}