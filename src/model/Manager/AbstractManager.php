<?php
namespace App\Manager;

abstract class AbstractManager
{
    private static $connexion;

    /**
     * Retourne une instance de PDO, représentant la connexion à la base de données
     * @return \PDO un objet instance de PDO, connecté à la base de données
     */
    protected static function connect()
    {
        self::$connexion = new \PDO(
            "mysql:dbname=forum;host=localhost:3306",
            "root",
            "Admin",
            [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            ]
        );
    }

    protected static function executeQuery($sql, $params = null)
    {
        $stmt = self::$connexion->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    protected static function getLastInsertId()
    {
        return intval(self::$connexion->lastInsertId());
    }

    /**
     * Récupère sous forme de $classname les résultats de $sql executée avec $params
     */
    protected static function getResults($classname, $sql, $params = null)
    {
        $stmt = self::executeQuery($sql, $params);
        $results = [];
        foreach($stmt->fetchAll(\PDO::FETCH_CLASS, $classname) as $obj){
            $results[] = $obj;
        }
        return $results;
    }

    protected static function getOneOrNullResult($classname, $sql, $params = null)
    {
        $stmt = self::executeQuery($sql, $params);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $classname);
        if($obj = $stmt->fetch()){
            return $obj;
        }
        return null;
    }
}