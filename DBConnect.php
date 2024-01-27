<?php

/**
 * Cette classe permet de se connecter à la base de données et de récupérer l'objet PDO
 * Cette classe est un singleton, il assure qu'elle n'a qu'une seule et même instance et fournit un point d'accès global à cette instance.
 */
class DBConnect {
    private static $instance = null;
    private $pdo;

    /**
     * Constructeur de la classe DBConnect, il est privé pour empêcher l'instanciation directe de la classe
     */
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=" . DB_HOST . ":" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASSWORD);
    }

    /**
     * Méthode qui permet de récupérer l'instance de la classe DBConnect. 
     * Stockée dans une propriété statique pour avoir toujours la même instance retournée. 
     * Le premier appel instancie la classe et tous les suivants retourneront l'instance déjà créée.
     * @return DBConnect
     */
    public static function getInstance(): DBConnect
    {
        if (self::$instance == null) {
            self::$instance = new DBConnect();
        }
        return self::$instance;
    }
    
    /**
     * Cette méthode permet de récupérer l'objet PDO qui permet de faire des requêtes sur la base de données
     * @return PDO
     */
    public function getPDO() : PDO
    {
        return $this->pdo;
    }
}
