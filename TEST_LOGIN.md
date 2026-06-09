# 🧪 Guide de test - Fonctionnalité Login Admin

## 📋 Prérequis

Avant de tester, assurez-vous que :

1. ✅ Le fichier SQL a été exécuté : `sql/feature_login_admin.sql`
2. ✅ Les routes ont été ajoutées dans `Router.php` (voir `ROUTES_A_AJOUTER.md`)
3. ✅ Les sessions PHP sont activées dans votre configuration
4. ✅ La base de données est correctement configurée dans `config/database.php`

## 🔐 Identifiants de test

**Email :** `admin@makerlab.com`  
**Mot de passe :** `Admin123!`

⚠️ **Important :** Changez ce mot de passe après le premier test en production !

## 🧪 Scénarios de test

### Test 1 : Affichage de la page de login
1. Accédez à : `http://localhost/login`
2. ✅ La page de login doit s'afficher avec un design moderne
3. ✅ Le formulaire doit contenir 2 champs : email et mot de passe

### Test 2 : Connexion avec identifiants valides
1. Sur la page `/login`, entrez :
   - Email : `admin@makerlab.com`
   - Mot de passe : `Admin123!`
2. Cliquez sur "Se connecter"
3. ✅ Vous devez être redirigé vers `/admin/dashboard`
4. ✅ Le dashboard doit afficher votre nom en haut à droite
5. ✅ Les statistiques et actions rapides doivent être visibles

### Test 3 : Connexion avec identifiants invalides
1. Sur la page `/login`, entrez :
   - Email : `wrong@email.com`
   - Mot de passe : `wrongpassword`
2. Cliquez sur "Se connecter"
3. ✅ Vous devez rester sur `/login`
4. ✅ Un message d'erreur rouge doit s'afficher : "Email ou mot de passe incorrect"

### Test 4 : Champs vides
1. Sur la page `/login`, laissez les champs vides
2. Cliquez sur "Se connecter"
3. ✅ Un message d'erreur doit s'afficher : "Veuillez remplir tous les champs"

### Test 5 : Protection des pages admin
1. Déconnectez-vous si vous êtes connecté
2. Essayez d'accéder directement à : `http://localhost/admin/dashboard`
3. ✅ Vous devez être redirigé automatiquement vers `/login`

### Test 6 : Déconnexion
1. Connectez-vous d'abord
2. Sur le dashboard, cliquez sur "Déconnexion"
3. ✅ Vous devez être redirigé vers `/login`
4. ✅ Essayez d'accéder à `/admin/dashboard` → vous devez être redirigé vers `/login`

### Test 7 : Redirection si déjà connecté
1. Connectez-vous
2. Essayez d'accéder à nouveau à `/login`
3. ✅ Vous devez être automatiquement redirigé vers `/admin/dashboard`

## 🔒 Tests de sécurité

### Test S1 : Injection SQL
1. Sur la page login, essayez d'entrer dans le champ email :
   ```
   admin@makerlab.com' OR '1'='1
   ```
2. ✅ La connexion doit échouer (protection par requêtes préparées)

### Test S2 : XSS
1. Essayez d'entrer dans le champ email :
   ```
   <script>alert('XSS')</script>
   ```
2. ✅ Le script ne doit pas s'exécuter (protection par `htmlspecialchars`)

### Test S3 : Vérification du hash de mot de passe
1. Connectez-vous à votre base de données
2. Consultez la table `admins`
3. ✅ Le mot de passe doit être hashé (commence par `$2y$`)
4. ✅ Le mot de passe ne doit JAMAIS être en clair

## 📊 Checklist finale

- [ ] Page de login accessible
- [ ] Connexion avec identifiants valides fonctionne
- [ ] Connexion avec identifiants invalides affiche une erreur
- [ ] Champs vides affichent une erreur
- [ ] Dashboard accessible après connexion
- [ ] Dashboard protégé si non connecté
- [ ] Déconnexion fonctionne
- [ ] Redirection automatique si déjà connecté
- [ ] Mot de passe hashé en base de données
- [ ] Pas de faille SQL injection
- [ ] Pas de faille XSS

## 🐛 Problèmes courants

### Erreur : "Class not found"
**Solution :** Vérifiez que l'autoloader est correctement configuré et que les namespaces correspondent.

### Erreur : "Headers already sent"
**Solution :** Assurez-vous qu'il n'y a pas d'espace ou de caractère avant `<?php` dans vos fichiers.

### Erreur : "Call to undefined method Database::getInstance()"
**Solution :** Vérifiez que la classe `Database` existe dans `config/database.php` et qu'elle implémente le pattern Singleton.

### La page login ne s'affiche pas
**Solution :** Vérifiez que les routes ont bien été ajoutées dans `Router.php`.

### Les sessions ne fonctionnent pas
**Solution :** Ajoutez `session_start();` au début de votre fichier `public/index.php`.

## 📝 Notes

- Les sessions PHP doivent être démarrées avant toute utilisation
- Le fichier `database.php` doit contenir une classe `Database` avec une méthode `getInstance()`
- Les contrôleurs utilisent le namespace `App\Controllers`
- Les modèles utilisent le namespace `App\Models`

## 🎉 Résultat attendu

Si tous les tests passent, vous avez un système de login admin fonctionnel et sécurisé !

---
**Dernière mise à jour :** 01/06/2026
