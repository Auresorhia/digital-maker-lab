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

        // 1. On lit le chemin demandé dans l'URL
        $chemin = $_SERVER['REQUEST_URI'];

        // 2. DÉTECTION DYNAMIQUE : On trouve le dossier de base automatiquement
        $basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);

        // 3. On soustrait la base du chemin pour ne garder que la route pure (ex: /login)
        if (substr($chemin, 0, strlen($basePath)) == $basePath) {
            $chemin = substr($chemin, strlen($basePath));
        }

        // 4. On nettoie l'URL (paramètres ?id=1) et on sécurise le premier slash
        $chemin = parse_url($chemin, PHP_URL_PATH);
        $chemin = '/' . trim($chemin, '/');

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

        } elseif ($chemin === '/new-password') {
            $controller = new \App\Controllers\LoginController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->handleNewPassword();
            } else {
                $controller->showNewPassword();
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