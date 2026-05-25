# Projet Digital Maker Lab 🎬🎥

Bonjour ! Voici le dépôt central pour notre projet de fin d'année. 
Ce site est développé en PHP Orienté Objet "from scratch".

## 🛠️ Comment installer le projet chez vous ?

1. Clonez ce dépôt sur votre ordinateur.
2. Créez une base de données nommée `digital_maker_lab` dans votre phpMyAdmin.
3. Importez le fichier `sql/init_db.sql` dans cette base pour avoir la même structure que tout le monde.
4. Lancez le serveur local en tapant cette commande dans votre terminal (depuis la racine du projet) : 
   `php -S localhost:8000 -t public`
*(Note : Si vous êtes sur Mac avec MAMP, pensez à mettre le mot de passe 'root' dans le fichier `config/database.php`).*

## 📂 Comment est organisé le projet ?

Une architecture MVC est déjà en place pour vous simplifier la vie. Merci de respecter ces dossiers :
* `src/Controllers/` : Pour vos contrôleurs.
* `src/Models/` : Pour faire vos requêtes à la base de données.
* `src/Views/` : Pour vos fichiers d'affichage HTML.
* `src/Core/`, `config/database.php` et `public/index.php`: ⛔ Touchez pas à ça ! (excepté le fichier src/core/Router.php)

## ⚠️ Les règles d'or pour Git

Le dépôt doit rester propre et documenté. Pour éviter les conflits et que l'on perde du temps :
* **Interdiction absolue de coder directement sur la branche `main` !**
* Créez toujours une branche au nom de votre fonctionnalité (ou à votre nom) pour développer votre partie.
* Quand votre travail est terminé, prévenez-moi. C'est moi qui m'occuperai d'intégrer votre code au projet principal !

Si jamais vous avez des questions, n'hésitez pas à venir me voir ou à me demander de l'aide ! Je ferai de mon mieux pour vous aider :)
