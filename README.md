# Projet Digital Maker Lab 🎬🎥

Bonjour ! Bienvenue sur le dépôt de notre projet interspécialités de fin d'année pour **Digital Campus Paris (Bachelor 2)**.

Ce site web a pour but de présenter les coulisses de la création digitale et de décrypter les grands métiers du numérique à travers une plateforme cohérente, pédagogique et accessible.

Ce projet est développé en **PHP Orienté Objet "from scratch"** et s'appuie sur une architecture MVC fait-maison.

---

## 👨🏻‍💻 Comment installer le projet en local chez vous? 

Pour faire tourner le site sur votre ordinateur, vous devez :

1. **Cloner le dépôt** sur votre ordinateur :
   ```bash
   git clone https://github.com/Auresorhia/digital-maker-lab
   cd projet-digital-maker-lab
   ```

2. **Configurer la base de données** :
   - Ouvrez votre outil de gestion de base de données.
   - Créez une nouvelle base de données nommée `digital_maker_lab`.
   - Importez le fichier initial situé dans `sql/init_db.sql` pour générer la structure commune.

3. **Gérer les identifiants locaux** :
   - Les configurations de connexion se trouvent dans `config/database.php`.
   - *Note pour les utilisateurs Mac (MAMP) :* Pensez à adapter les identifiants (comme le mot de passe `root`) dans le fichier `config/database.php` si nécessaire pour votre environnement local.

1. **Pour lancer le serveur local PHP** :
   - Ouvrez votre terminal à la racine du projet et exécutez la commande suivante :
     ```bash
     php -S localhost:8000 -t public
     ```
   - Ouvrez votre navigateur et rendez-vous sur [http://localhost:8000](http://localhost:8000).

---

## 🗃️ Organisation de l'Architecture (MVC)

Le projet est pré-structuré pour séparer la logique métier de l'affichage. Vous devez impérativement coder dans les dossiers dédiés à vos fonctionnalités :

* `src/Controllers/` : Pour placer vos contrôleurs (gestion de la logique de vos plugins).
* `src/Models/` : Pour placer vos modèles et effectuer vos requêtes SQL à la base de données.
* `src/Views/` : Pour intégrer vos fichiers d'affichage HTML (les morceaux de pages ou gabarits).

> ‼️ **ZONE INTERDITE :** Ne modifiez pas les fichiers de configuration généraux, le reste du dossier `src/Core/`, le fichier `public/index.php` ou la configuration globale de la base de données (config/) sans m'en parler.

---

## 🎟️ Gestion des Fonctionnalités (GitHub Issues) 

**Rappel : Tâches = Tickets = Issues**

Pour que le développement reste fluide et sous contrôle, nous utilisons un système de validation par Tickets (/Tâches) :

* **Règle d'or (Découpez vos tâches !) :** Ne créez pas un seul ticket géant pour une fonctionnalité énorme (ex: "Faire le mini CMS"). Découpez votre fonctionnalité en petites tâches et créez un ticket pour chacune (ex: Ticket 1 : "Créer la table SQL", Ticket 2 : "Faire la page de connexion", etc.). C'est plus clair pour vous, et plus facile à suivre pour moi.
* **Créez votre Tâche (Issue) :** Dans l'onglet *Issues* sur GitHub, cliquez sur **New Issue**. Prenez le modèle de ticket (Création de fonctionnalité) et remplissez juste les champs. **Faites-moi ensuite un petit message sur Discord pour me prévenir que le ticket est en attente.**
* **Revue Technique :** Je vais relire votre ticket pour m'assurer que cette étape respecte bien notre architecture globale MVC et ne risque pas de bloquer les autres groupes ou la base de données.
* **Le Feu Vert (Assignation) :** Une fois le ticket validé techniquement, je vous l'assignerai officiellement. Cette assignation est votre "GO" officiel pour créer votre branche `feature-` et commencer à coder !

---

## 🖥️ Les Espaces de Travail (Branches Git) 

Le dépôt est structuré en deux espaces principaux pour garantir la stabilité du site en ligne :

* 🔵 **La branche `dev` (Développement) :** C'est notre espace d'intégration. C'est ici que l'on rassemble toutes les fonctionnalités pour vérifier qu'elles fonctionnent ensemble. C'est votre branche de référence pour démarrer. Donc c'est là que vous allez faire vos Pull Request.

* 🟢 **La branche `main` (Production) :** C'est la vitrine officielle du projet. Le code présent sur cette branche doit être 100% fonctionnel et testé. **Il est strictement interdit de coder ou de pusher directement sur `main`.**


---

## 🤺 Le Workflow Git 

Voici la routine à suivre à chaque fois que vous développez votre fonctionnalité :

### Étape 1 : Se mettre à jour
Avant tout développement, récupérez la dernière version propre du code :
```bash
git checkout develop
git pull origin develop
```

### Étape 2 : Créer sa branche locale
Créez une branche dédiée à partir de `develop` en respectant la nomenclature professionnelle suivante : `feature-[nom-de-la-fonctionnalite]`
```bash
git checkout -b feature-nom-du-plugin
```
*(Exemples : `feature-plugin-backoffice`, `feature-chatbot`)*

### Étape 3 : Coder et sauvegarder (Commit)
Faites des sauvegardes régulières avec des messages clairs et explicites :
```bash
git add .
git commit -m "Ajout du formulaire de saisie pour le plugin de back-office"
```

### Étape 4 : Envoyer votre code sur GitHub (Push)
Une fois votre fonctionnalité terminée et testée localement, poussez votre branche sur le dépôt distant :
```bash
git push origin feature-nom-du-plugin
```

### Étape 5 : Ouvrir une Pull Request (PR)
1. Sur la page GitHub du projet.Cliquez sur le bouton vert **Compare & pull request**
2. Configurez la demande pour fusionner votre branche **vers la branche `develop`** (et non vers `main`)
3. Décrivez brièvement ce que fait votre code

C'est moi qui me chargerai de relire le code, de le tester et de valider la Pull Request pour l'intégrer au projet global !

---

## 🍡 Règle pour la Base de Données

Si votre fonctionnalité a besoin d'enregistrer des données (tables supplémentaires, nouveaux champs) :
* **Ne modifiez jamais** le fichier `sql/init_db.sql` directement pour éviter les conflits d'écrasement.
* **La solution :** Créez un petit fichier SQL indépendant dans le dossier `sql/` contenant uniquement vos requêtes SQL. Mentionnez-le clairement dans votre Pull Request pour que je puisse mettre à jour la base globale.

---

## 🤝 Besoin d'aide ou bloqué ?

Si vous rencontrez des problèmes, si vous avez un doute sur l'emplacement d'un fichier ou juste si vous avez une question, n'hésitez PAS à venir me voir !!
