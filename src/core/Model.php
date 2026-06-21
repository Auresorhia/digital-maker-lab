<?php


abstract class Model
{
    // Cette propriété sera partagée avec tous les sous-modèles enfants
    protected $db;

    public function __construct()
    {
        // On récupère l'unique instance de PDO via le Singleton
        $this->db = \Database::getInstance();
    }
}
