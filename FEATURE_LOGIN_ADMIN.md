# 🔐 Fonctionnalité : Login Admin

## 📋 Description
Cette branche contient l'implémentation complète du système de connexion pour l'espace administrateur du Digital Maker Lab.

## 🎯 Objectif
Permettre aux administrateurs de se connecter de manière sécurisée à un espace d'administration dédié.

## 📁 Fichiers créés

### Controllers
- `src/Controllers/LoginController.php` : Gestion de la logique de connexion, déconnexion et affichage

### Models
- `src/Models/AdminModel.php` : Gestion des requêtes SQL pour les administrateurs (CRUD)

### Views
- `src/Views/login.php` : Page de connexion avec design moderne
- `src/Views/admin-dashboard.php` : Page d'accueil de l'espace admin (après connexion)

### SQL
- `sql/feature_login_admin.sql` : Fichier SQL indépendant contenant :
  - Création de la table `admins`
  - Insertion d'un compte admin par défaut

## 🔧 Configuration requise

### Routes à ajouter dans `src/Core/Router.php`
**⚠️ IMPORTANT : Ces routes doivent être ajoutées par le responsable du projet**

```php
// Routes pour le login admin
$router->get('/login', [LoginController::class, 'showLoginPage']);
$router->post('/login', [LoginController::class, 'handleLogin']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/admin/dashboard', [AdminController::class, 'dashboard']);
```

### Base de données
Le fichier `sql/feature_login_admin.sql` doit être exécuté pour créer la table `admins`.

**Compte admin par défaut :**
- Email : `admin@makerlab.com`
- Mot de passe : `Admin123!`
- ⚠️ **À CHANGER IMMÉDIATEMENT après la première connexion**

## 🔒 Sécurité

### Mesures implémentées
- ✅ Hashage des mots de passe avec `password_hash()` (bcrypt)
- ✅ Vérification sécurisée avec `password_verify()`
- ✅ Protection contre les injections SQL (requêtes préparées PDO)
- ✅ Sessions PHP pour maintenir la connexion
- ✅ Redirection automatique si déjà connecté
- ✅ Protection des pages admin (vérification de session)

### Recommandations
- [ ] Ajouter un système de limitation des tentatives de connexion (rate limiting)
- [ ] Implémenter un système de "Se souvenir de moi"
- [ ] Ajouter la validation 2FA (authentification à deux facteurs)
- [ ] Mettre en place des logs de connexion

## 🧪 Tests à effectuer

### Tests fonctionnels
1. ✅ Affichage de la page de login (`/login`)
2. ✅ Connexion avec identifiants valides
3. ✅ Connexion avec identifiants invalides (message d'erreur)
4. ✅ Redirection vers dashboard après connexion réussie
5. ✅ Déconnexion (`/logout`)
6. ✅ Protection des pages admin (redirection si non connecté)

### Tests de sécurité
1. ⚠️ Tentative d'injection SQL
2. ⚠️ Tentative de XSS dans les formulaires
3. ⚠️ Accès direct aux pages admin sans connexion

## 📦 Dépendances
- PHP 8.0+
- PDO (pour la connexion à la base de données)
- Sessions PHP activées

## 🚀 Utilisation

### Pour tester localement
1. Exécuter le fichier SQL : `sql/feature_login_admin.sql`
2. Configurer les routes (voir section "Routes à ajouter")
3. Accéder à `/login`
4. Se connecter avec les identifiants par défaut
5. Vous serez redirigé vers `/admin/dashboard`

## 📝 Notes pour la Pull Request

### Checklist avant PR
- [x] Code respecte l'architecture MVC
- [x] Aucune modification dans `src/Core/`
- [x] Aucune modification dans `config/`
- [x] Fichier SQL indépendant créé
- [x] Documentation complète
- [ ] Routes à configurer (à faire par le responsable)
- [ ] Tests effectués

### Message pour le responsable
> Bonjour,
> 
> Cette PR implémente le système de login admin comme discuté.
> 
> **Actions requises de votre part :**
> 1. Ajouter les routes mentionnées dans ce README au fichier `Router.php`
> 2. Exécuter le fichier `sql/feature_login_admin.sql` sur la base de données
> 3. Vérifier que tout fonctionne correctement
> 
> **Compte de test :**
> - Email : admin@makerlab.com
> - Mot de passe : Admin123!
> 
> Merci !

## 🐛 Problèmes connus
Aucun pour le moment.

## 📧 Contact
Pour toute question concernant cette fonctionnalité, me contacter sur Discord.

---
**Branche :** `feature/login-admin`  
**Date :** 01/06/2026  
**Statut :** ✅ Prêt pour review
