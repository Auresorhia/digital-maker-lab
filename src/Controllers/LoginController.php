<?php

namespace App\Controllers;

require_once __DIR__ . '/../Models/AdminModel.php';

class LoginController
{
    private \App\Models\AdminModel $adminModel;

    public function __construct()
    {
        $this->adminModel = new \App\Models\AdminModel();
    }

    /**
     * Affiche la page de connexion
     */
    public function showLoginPage(): void
    {
        // Vérifier si l'utilisateur est déjà connecté
        if (isset($_SESSION['admin_id'])) {
            header('Location: /admin/dashboard');
            exit;
        }

        require_once __DIR__ . '/../Views/login.php';
    }

    /**
     * Traite la tentative de connexion
     */
    public function handleLogin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        $identifiant = $_POST['identifiant'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validation basique
        if (empty($identifiant) || empty($password)) {
            $_SESSION['error'] = 'Veuillez remplir tous les champs';
            header('Location: /login');
            exit;
        }

        // Vérification des identifiants
        $admin = $this->adminModel->findByIdentifiant($identifiant);

        if ($admin && password_verify($password, $admin['password'])) {
            // Connexion réussie
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_identifiant'] = $admin['identifiant'];

            header('Location: /admin/dashboard');
            exit;
        } else {
            // Échec de la connexion
            $_SESSION['error'] = 'Identifiant ou mot de passe incorrect';
            header('Location: /login');
            exit;
        }
    }

    /**
     * Déconnexion de l'administrateur
     */
    public function logout(): void
    {
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }

    /**
     * Affiche la page "Mot de passe oublié" (saisie de l'email)
     */
    public function showForgotPassword(): void
    {
        require_once __DIR__ . '/../Views/forgot-password.php';
    }

    /**
     * Traite la demande : génère un code à 4 chiffres et l'envoie par email
     */
    public function handleForgotPassword(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /forgot-password');
            exit;
        }

        $email = trim($_POST['email'] ?? '');

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Veuillez saisir une adresse email valide';
            header('Location: /forgot-password');
            exit;
        }

        $admin = $this->adminModel->findByEmail($email);

        // Si l'email existe, on génère et on envoie le code.
        // Note : pour des raisons de sécurité, on affiche toujours le même
        // message de succès, que l'email existe ou non.
        if ($admin) {
            // Code à 4 chiffres (1000 à 9999)
            $code = (string) random_int(1000, 9999);

            $this->adminModel->saveResetCode($email, $code, 10);

            $subject = 'Votre code de réinitialisation - Digital Maker Lab';
            $message = "Bonjour,\n\n"
                . "Vous avez demandé à réinitialiser votre mot de passe.\n"
                . "Votre code de vérification est : {$code}\n\n"
                . "Ce code est valable 10 minutes.\n\n"
                . "Si vous n'êtes pas à l'origine de cette demande, ignorez cet email.\n\n"
                . "— Digital Maker Lab";
            $headers = 'From: no-reply@digital-maker-lab.test' . "\r\n"
                . 'Content-Type: text/plain; charset=UTF-8';

            @mail($email, $subject, $message, $headers);

            // On retient l'email pour l'étape suivante
            $_SESSION['reset_email'] = $email;
        }

        $_SESSION['success'] = "Si un compte est associé à cette adresse, un code à 4 chiffres vient d'être envoyé par email.";
        header('Location: /reset-password');
        exit;
    }

    /**
     * Affiche la page de réinitialisation (code + nouveau mot de passe)
     */
    public function showResetPassword(): void
    {
        require_once __DIR__ . '/../Views/reset-password.php';
    }

    /**
     * Traite la réinitialisation : vérifie le code et met à jour le mot de passe
     */
    public function handleResetPassword(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /reset-password');
            exit;
        }

        $email = trim($_POST['email'] ?? ($_SESSION['reset_email'] ?? ''));
        $code = trim($_POST['code'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        if (empty($email) || empty($code) || empty($password) || empty($passwordConfirm)) {
            $_SESSION['error'] = 'Veuillez remplir tous les champs';
            header('Location: /reset-password');
            exit;
        }

        if (!preg_match('/^\d{4}$/', $code)) {
            $_SESSION['error'] = 'Le code doit contenir 4 chiffres';
            header('Location: /reset-password');
            exit;
        }

        if ($password !== $passwordConfirm) {
            $_SESSION['error'] = 'Les mots de passe ne correspondent pas';
            header('Location: /reset-password');
            exit;
        }

        if (strlen($password) < 8) {
            $_SESSION['error'] = 'Le mot de passe doit contenir au moins 8 caractères';
            header('Location: /reset-password');
            exit;
        }

        if (!$this->adminModel->verifyResetCode($email, $code)) {
            $_SESSION['error'] = 'Code invalide ou expiré';
            header('Location: /reset-password');
            exit;
        }

        $this->adminModel->updatePasswordByEmail($email, $password);

        unset($_SESSION['reset_email']);
        $_SESSION['success'] = 'Votre mot de passe a été réinitialisé. Vous pouvez vous connecter.';
        header('Location: /login');
        exit;
    }
}
