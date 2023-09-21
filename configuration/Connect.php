<?php

class Connect
{
    // Méthodes

    /**
     * Une méthode statique permet de faire appel à une méthode sans instancier la classe
     */
    
    public static function connect() 
    {
        $db_name = 'biblioapp';
        $db_user = 'root';
        $db_pass = '';
        $db_host = '127.0.0.1:3306';

        try {
            $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
            // echo "<h1>Connexion à la base de données réussie</h1>";
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }
}