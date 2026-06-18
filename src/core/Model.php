<?php

// Si ton fichier config/database.php n'utilise pas de namespace, 
// on pourra appeler la classe avec un antislash (\Database) pour indiquer à PHP qu'elle est globale.
abstract class Model
{
    // Cette propriété sera partagée avec tous les sous-modèles enfants
    protected $db;

    public function __construct()
    {
        // On récupère l'unique instance de PDO via ton Singleton
        // Le \ devant Database permet de la trouver même si on est dans le namespace App\Core
        $this->db = \Database::getInstance();
    }
}
