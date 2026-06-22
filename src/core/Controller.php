<?php
namespace Core;

class Controller
{

    // Cette méthode sera utilisée par tous vos futurs contrôleurs
    protected function render($cheminDeLaVue, $donnees = [])
    {
        // extract() transforme un tableau de données en variables simples.
        extract($donnees);
        $fichier = "../src/Views/" . $cheminDeLaVue . ".php";

        if (file_exists($fichier)) {
            require_once $fichier;
        } else {
            echo "Erreur : La vue $cheminDeLaVue n'existe pas.";
        }
    }
}
