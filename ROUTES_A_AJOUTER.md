# 🛣️ Routes à ajouter dans Router.php

## ⚠️ IMPORTANT
Ces routes doivent être ajoutées par le responsable du projet dans le fichier `src/Core/Router.php`

## 📝 Routes pour la fonctionnalité Login Admin

```php
// ============================================
// ROUTES ADMIN - Fonctionnalité Login
// ============================================

use App\Controllers\LoginController;
use App\Controllers\AdminController;

// Page de connexion (GET)
$router->get('/login', [LoginController::class, 'showLoginPage']);

// Traitement de la connexion (POST)
$router->post('/login', [LoginController::class, 'handleLogin']);

// Déconnexion
$router->get('/logout', [LoginController::class, 'logout']);

// Dashboard admin (page d'accueil après connexion)
$router->get('/admin/dashboard', [AdminController::class, 'dashboard']);

// ============================================
```

## 🔍 Exemple d'intégration

Si votre Router.php ressemble à ceci :

```php
<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    // ... autres méthodes
}
```

Alors ajoutez les routes dans le fichier qui instancie le Router (probablement `public/index.php` ou un fichier de routes dédié).

## 📋 Checklist d'intégration

- [ ] Ajouter les imports des contrôleurs en haut du fichier
- [ ] Ajouter les 4 routes listées ci-dessus
- [ ] Vérifier que les sessions sont démarrées (`session_start()`)
- [ ] Tester l'accès à `/login`
- [ ] Tester la connexion
- [ ] Tester l'accès au dashboard
- [ ] Tester la déconnexion

## 🧪 URLs de test

Après intégration, ces URLs doivent être accessibles :

- `http://localhost/login` → Page de connexion
- `http://localhost/logout` → Déconnexion
- `http://localhost/admin/dashboard` → Dashboard admin (nécessite connexion)

## 💡 Note

Si votre architecture utilise un système de routing différent, adaptez le format des routes en conséquence.
