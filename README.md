# Projet Digital Maker Lab 🎬🎥

Bonjour ! Bienvenue sur le dépôt de notre projet interspécialités de fin d'année pour **Digital Campus Paris (Bachelor 2)**.

Ce site web a pour but de présenter les coulisses de la création digitale et de décrypter les grands métiers du numérique à travers une plateforme cohérente, pédagogique et accessible.

Ce projet est développé en **PHP Orienté Objet "from scratch"** et s'appuie sur une architecture MVC fait-maison.



## 👨🏻‍💻 Comment installer le projet en local chez vous? 

1. **Cloner le dépôt** sur votre ordinateur :
   ```bash
   git clone https://github.com/Auresorhia/digital-maker-lab
   cd projet-digital-maker-lab
   ```

2. **Configurer la base de données** :
   - Ouvrez votre outil de gestion de base de données.
   - Créez une nouvelle base de données nommée `digital_maker_lab`.
   - Importez le fichier initial situé dans `sql/init_db.sql`, Magie ! vous êtes à jour sur la bdd.

3. **Gérer les identifiants locaux** :
   - Les configurations de connexion se trouvent dans `config/database.php`.
   - *Note pour les utilisateurs Mac (MAMP) :* Pensez à adapter les identifiants (ex: le mdp `root`) pour votre environnement local.

1. **Pour lancer le serveur local PHP** :
   - Ouvrez votre terminal à la racine du projet et exécutez cette commande:
     ```bash
     php -S localhost:8000 -t public
     ```
   - Allez sur [http://localhost:8000]



## 🗃️ Organisation de l'Architecture (MVC)

Le MVC sert à séparer la logique métier de l'affichage. Vous devez coder que dans les dossiers dédiés à vos fonctionnalités :

* `src/Controllers/` : Pour placer vos contrôleurs (gestion de la logique de vos plugins).
* `src/Models/` : Pour placer vos modèles et effectuer vos requêtes SQL à la base de données.
* `src/Views/` : Pour intégrer vos fichiers d'affichage HTML (les morceaux de pages ou gabarits).

* ⚠️ **RÈGLE POUR LES ROUTES (`src/Core/Router.php`) :** Le fichier `Router.php` centralise tous les accès aux pages du site. **Il est strictement interdit de modifier ce fichier directement**. Si votre fonctionnalité a besoin de créer une nouvelle page (et donc d'une nouvelle route), mentionnez-le obligatoirement dans votre ticket (Issue) et **envoyez-moi un message privé sur Discord** pour que nous configurions la route ensemble.

> ‼️ **ZONE INTERDITE :** Ne modifiez pas le dossier `src/Core/`, le fichier `public/index.php` ou la configuration globale de la base de données (config/) sans m'en parler.


## 🎟️ Gestion des Fonctionnalités (GitHub Issues) 

**Rappel : Issues = Tickets (Tickets de Tâche + Tickets de Bug)**

Pour que le développement reste fluide et sous contrôle, nous utilisons un système de validation par Tickets :

* **🪙 Règle d'or (Découpez vos tâches !) :** Ne créez pas un seul ticket géant pour une fonctionnalité énorme (ex: "Faire le mini CMS"). Découpez votre fonctionnalité en petits tickets de tâche et créez un ticket pour chacune (ex: Ticket 1 : "Créer la table SQL", Ticket 2 : "Faire la page de connexion"). C'est plus clair pour vous, et plus facile à suivre pour moi.

* **Créez votre Tâche (Issue) :** Dans l'onglet *Issues* sur GitHub, cliquez sur **New Issue**. Prenez le modèle de ticket "Création de fonctionnalité" et remplissez juste les champs. **Faites-moi ensuite un petit message sur Discord une fois le ticket **créé**.**

* **🐛 Signalez un Bug (Issue) :** Le principe est exactement le même ! Si vous repérez une erreur, créez un ticket par problème en utilisant le modèle "Signalement de Bug". Ne faites surtout pas de listes groupées. Prévenez-moi aussi sur Discord une fois le ticket **créé**.

* **Le Tableau de Bord (GitHub Projects) :** Un tableau de suivi est disponible dans l'onglet **Projects** du dépôt.
  Un tableau de suivi est disponible dans l'onglet _Projects_ du dépôt pour voir l'avancée globale. Voici comment lire ses 3 colonnes :

	* **⚪ À faire :** Le ticket est créé, validé par moi, et prêt à être codé
	* **🟡 En cours :** Un développeur est en train d'écrire le code pour ce ticket
	* **🟢 Terminé :** La tâche est finie, le code a été vérifié et je l'ai officiellement fusionné dans notre architecture de base

   Dès que vous créez votre ticket, il se place **automatiquement** dans la colonne **À faire**. ça permet à tout le monde (surtout à moi) de voir l'avancée globale de chaque fonctionnalité .
 
* **Revue Technique :** Je vais relire votre ticket pour m'assurer que cette étape respecte bien l'architecture et que ça ne casse pas la bdd. Puis je me charge d'ajouter des étiquettes de couleur ("bug", "base de données", etc.) pour bien catégoriser les issues.

* ✅ **Le Feu Vert (Assignation) :** Une fois le ticket validé, je vous l'assignerai officiellement. Cette assignation est votre "GO" officiel pour créer votre branche `feature-` et commencer à coder !

* ❌ En cas de refus : Si un ticket est incomplet, mal découpé, ou qu'il ne s'agit pas d'un vrai bug lié au socle commun du projet, je le fermerai avec un commentaire explicatif pour que vous puissiez le corriger.

* **Mise à jour et automatisation :** Le tableau vit tout seul. Le ticket passera automatiquement dans **En cours** puis dans **Terminé** au fil de vos Pull Requests.
  
  * ⚠️ **Règle de secours :** Si vous commencez à coder votre tâche avant d'avoir ouvert votre Pull Request sur GitHub, vous avez les droits d'écriture pour glisser vous-mêmes manuellement votre ticket dans la colonne **En cours** afin que l'on sache que vous êtes dessus.


## 🖥️ Les Espaces de Travail (Branches Git) 

Le dépôt est structuré en deux espaces principaux pour garantir la stabilité du site en ligne :

* 💿 **La branche `dev` (Développement) :** C'est notre espace d'intégration. C'est ici que l'on rassemble toutes les fonctionnalités pour vérifier qu'elles fonctionnent ensemble. C'est votre branche de référence pour démarrer. Donc c'est là que vous allez faire vos Pull Request.

* 📀 **La branche `main` (Production) :** C'est la vitrine officielle du projet. Le code présent sur cette branche doit être 100% fonctionnel et testé. **Il est strictement interdit de coder ou de pusher directement sur `main`.**




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



## 🍡 Règle pour la Base de Données

Si votre fonctionnalité a besoin d'enregistrer des données (tables supplémentaires, nouveaux champs) :
* **Ne modifiez jamais** le fichier `sql/init_db.sql` directement pour éviter les conflits d'écrasement.
* **La solution :** Créez un petit fichier SQL indépendant dans le dossier `sql/` contenant uniquement vos requêtes SQL. Mentionnez-le clairement dans votre Pull Request pour que je puisse mettre à jour la base globale.



## 🤝 Besoin d'aide ou bloqué ?

Si vous rencontrez des problèmes, si vous avez un doute sur l'emplacement d'un fichier ou juste si vous avez une question, n'hésitez PAS à venir me voir !!
