<?php

require_once __DIR__ . '/../core/Controller.php';

class AdminController extends Controller
{
    /**
     * Affiche le dashboard admin
     */
    public function dashboard(): void
    {
        // Vérifier que l'utilisateur est connecté
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /login');
            exit;
        }

        require_once __DIR__ . '/../Views/admin-dashboard.php';
    }

    /**
     * Middleware pour vérifier l'authentification
     * À appeler avant chaque action admin
     */
    public function checkAuth(): bool
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /login');
            exit;
        }
        return true;
    }
}
