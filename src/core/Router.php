<?php

// On charge les contrôleurs nécessaires
require_once __DIR__ . '/../Controllers/LoginController.php';
require_once __DIR__ . '/../Controllers/AdminController.php';


class Router {

    public function start() {
        // On démarre la session pour pouvoir utiliser $_SESSION
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // On lit le chemin demandé dans l'URL et on supprime les éventuels paramètres GET
        $chemin = strtok($_SERVER['REQUEST_URI'], '?');

        if ($chemin === '/') {
            echo "Voici la page d'accueil";
        } elseif ($chemin === '/metiers') {
            echo "Voici la page des métiers";
        
        // --- NOUVELLES ROUTES POUR LE LOGIN ADMIN ---

        } elseif ($chemin === '/login') {
            $controller = new \App\Controllers\LoginController();
            // On vérifie si la requête est en POST pour traiter le formulaire
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->handleLogin();
            } else {
                $controller->showLoginPage();
            }

        } elseif ($chemin === '/forgot-password') {
            $controller = new \App\Controllers\LoginController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->handleForgotPassword();
            } else {
                $controller->showForgotPassword();
            }

        } elseif ($chemin === '/reset-password') {
            $controller = new \App\Controllers\LoginController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->handleResetPassword();
            } else {
                $controller->showResetPassword();
            }

        } elseif ($chemin === '/admin/dashboard') {
            $controller = new \App\Controllers\AdminController();
            $controller->dashboard();

        } elseif ($chemin === '/logout') {
            $controller = new \App\Controllers\LoginController();
            $controller->logout();
        
        } else {
            // Si aucune route ne correspond, on affiche une erreur 404
            http_response_code(404);
            echo "Page non trouvée";
        }
    }
}