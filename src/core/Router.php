<?php
class Router
{

    public function start(string $url)
    {
        $chemin = $url;

        if ($chemin === '/') {
            // Appel du Contrôleur de la page d'accueil
            require_once '../src/Controllers/HomeController.php';
            $controller = new HomeController();
            $controller->index();
        } elseif ($chemin === '/metiers') {
            require_once '../src/Controllers/FinderController.php';
            $controller = new FinderController();
            $controller->index();
        } elseif ($chemin === '/api/search') {
            require_once __DIR__ . '/../Controllers/SearchController.php';
            $controller = new SearchController();
            $controller->autocomplete();


            //Page admin dashbord
        } elseif ($chemin === '/admin/jobs') {
            require_once __DIR__ . '/../../config/database.php';

            require_once __DIR__ . '/../Models/Job/JobModel.php';
            require_once __DIR__ . '/../Models/Specialty/SpecialtyModel.php';

            require_once __DIR__ . '/../Controllers/job/AdminJobController.php';

            $db = Database::getInstance();
            $controller = new \Controllers\AdminJobController($db);
            $controller->index();


            //Page admin créer un métier
        } elseif ($chemin === '/admin/jobs/create') {
            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/Specialty/SpecialtyModel.php';

            require_once __DIR__ . '/../Controllers/specialty/AdminSpecialtyController.php';

            $db = Database::getInstance();
            $controller = new \Controllers\AdminSpecialtyController($db);
            $controller->create();

            //page spécialités
        } elseif ($chemin === '/admin/specialties') {

            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/Specialty/SpecialtyModel.php';
            require_once __DIR__ . '/../Controllers/specialty/AdminSpecialtyController.php';

            $db = Database::getInstance();

            $controller = new \Controllers\AdminSpecialtyController($db);
            $controller->index();


        //Page admin créer une spécialité
        } elseif ($chemin === '/admin/specialties/create') {
            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/Specialty/SpecialtyModel.php';


            require_once __DIR__ . '/../Controllers/specialty/AdminSpecialtyController.php';

            $db = Database::getInstance();
            $controller = new \Controllers\AdminSpecialtyController($db);
            $controller->create();

            //Page admin éditer un métier
            /*} elseif (preg_match('#^/admin/jobs/(\d+)/edit$#', $chemin, $matches)) {
            // L'ID capturé dans l'URL se trouve dans $matches[1]
            $id = (int) $matches[1];

            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/Job/JobModel.php';
            require_once __DIR__ . '/../Models/Specialty/SpecialtyModel.php'; // On le charge au cas où le formulaire d'édition en ait besoin pour un menu déroulant
            require_once __DIR__ . '/../Controllers/job/AdminJobController.php';

            $db = Database::getInstance();
            $controller = new \Controllers\AdminJobController($db);
            $controller->edit($id);*/


            //Page admin supprimer un métier
            /*} elseif (preg_match('#^/admin/jobs/(\d+)/delete$#', $chemin, $matches)) {
            // L'ID capturé dans l'URL se trouve dans $matches[1]
            $id = (int) $matches[1];

            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/Job/JobModel.php';
            require_once __DIR__ . '/../Controllers/job/AdminJobController.php';

            $db = Database::getInstance();
            $controller = new \Controllers\AdminJobController($db);
            $controller->delete($id);*/


            //Page ajouter des events
            /*} elseif ($chemin === '/admin/evenements/ajouter') {
            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/Event.php'; // D'après la ligne 11 de son code
            require_once __DIR__ . '/../Controllers/EventController.php';

            $db = Database::getInstance();

            $controller = new \EventController($db);

            $controller->create();*/
        } else {
            echo "<h1>Erreur 404</h1><p>Page introuvable.</p>";
        }
    }
}
