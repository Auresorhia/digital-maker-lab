
## 👨🏻‍💻 Installation en local

**1. Cloner le dépôt et entrer dans le dossier :**
```bash
git clone https://github.com/Auresorhia/digital-maker-lab
cd digital-maker-lab
````

**2. Configurer la base de données :**

- Créez une base de données nommée `digital_maker_lab` dans votre outil de gestion.
- Importez le fichier `sql/init_db.sql`.
- Vérifiez vos identifiants dans `config/database.php` _(Utilisateurs Mac/MAMP : pensez à adapter le mot de passe root)_.
    

**3. Lancer le serveur local PHP :**

Bash

```
php -S localhost:8000 -t public
```

Allez sur [http://localhost:8000](https://www.google.com/search?q=http://localhost:8000&authuser=2).

## 🗃️ Architecture MVC : Règles de base

Le code est strictement organisé pour séparer la logique de l'affichage :

- `src/Controllers/` : Logique de vos fonctionnalités et plugins.
- `src/Models/` : Requêtes SQL vers la base de données.
- `src/Views/` : Affichage HTML et gabarits.
    

## ‼️ **ZONES INTERDITES :**

- **`src/Core/Router.php`** : Centralise toutes les routes. Il est strictement interdit de le modifier. Si vous avez besoin d'une nouvelle page, précisez-le dans votre ticket et je configurerai la route.
- **`src/Core/`**, **`public/index.php`** et **`config/`** : Ne modifiez jamais ces dossiers/fichiers sans mon accord explicite.
     

## 🎟️ Gestion des tickets (Issues)

**🪙 Règle d'or : 1 Ticket = 1 Branche = 1 Petite tâche.** Ne créez pas de ticket "fourre-tout" (ex: "Faire le mini CMS"). Découpez au maximum (ex: "Créer la table SQL CMS", "Faire l'UI de connexion").

Suivez l'avancée sur le tableau **GitHub Projects**. Voici le cycle de vie d'un ticket :
 
- **En revue** : Attribuez ce statut dès la création du ticket. **Attendez mon "Feu Vert" et mon assignation avant de commencer à coder.**
- - **À faire** : Le ticket a été validé et ous êtes assigné au ticket, vous pouvez créer votre branche et coder. 
- **En cours** : Le ticket est en cours de developpement.
- **Terminé** : Le code a été vérifié et fusionné au projet.
    

## 🖥️ Branches et Workflow Git

Nous utilisons deux branches principales :

- 💿 **`dev`** : Espace d'intégration des nouvelles fonctionnalités. **Toutes vos Pull Requests (PR) pointeront ici.**
- 📀 **`main`** : Code de production 100% testé. Interdiction stricte de pousser directement dessus.
    

### Le Workflow du développeur :

**1. Toujours se mettre à jour avant de coder :**

Bash

```
git checkout dev
git pull origin dev
```

**2. Créer sa branche locale (Nomenclature stricte) :**

Respectez le format `feat/[fonctionnalite]` :

Bash

```
git checkout -b feat/quiz-bdd
ou
git checkout -b feat/chat-controller
```

**3. Coder et sauvegarder régulièrement :**

Bash

```
git add .
git commit -m "Ajout du formulaire de saisie pour le back-office"
```

**4. Envoyer le code :**

Bash

```
git push origin feat/votre-nom-de-branche
```

**5. Ouvrir une Pull Request (PR) :**

Sur GitHub, ouvrez une PR de votre branche vers **`dev`**. Décrivez vos modifications et attendez ma relecture pour la fusion.

## 🍡 Base de données

Si votre ticket nécessite de nouvelles tables ou champs :

1. **Ne modifiez jamais** directement le fichier `sql/init_db.sql` global.
    
2. Créez un **petit fichier SQL indépendant** dans le dossier `sql/` contenant uniquement vos requêtes.
    
3. Mentionnez ce fichier dans votre PR pour que je mette à jour la base globale sans conflit.
    

## 🤝 Besoin d'aide ?

Si vous rencontrez des problèmes, si vous avez un doute sur l'emplacement d'un fichier ou juste si vous avez une question, n'hésitez PAS à venir me voir !!
