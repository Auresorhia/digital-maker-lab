<?php

class Database {
    // C'est ici qu'on stocke notre connexion unique
    private static $instance = null;

    // 1. On bloque le constructeur en le mettant en 'private'
    // Ça empêche de faire "new Database()" dans votre code (oui vous là)
    private function __construct() {}

    // 2. La seule méthode que vous aurez le droit d'utiliser
    public static function getInstance() {
        // Si la connexion n'existe pas encore, on la crée
        if (self::$instance === null) {
            try {
                $host = '127.0.0.1';  // Utiliser 127.0.0.1 au lieu de localhost pour MAMP
                $port = '8889';       // Port par défaut de MAMP (3306 si vous utilisez MAMP PRO)
                $dbname = 'digital_maker_lab';
                $username = 'root';
                $password = 'root'; // ATTENTION : si vous êtes sur Mac (MAMP), remplacez le mot de passe vide par 'root'!

                // Pour se connecter
                self::$instance = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
                
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//affiche les erreurs en cas...d'erreur
                
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        // On retourne la connexion prête
        return self::$instance;
    }
}