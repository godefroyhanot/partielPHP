# Escape Game - Projet PHP

Ce projet est un site web permettant de créer et de répondre à des énigmes en ligne. Il a été développé dans le cadre d'un partiel de PHP en année 2 de développement web.

## Fonctionnalités

- **Ajouter une question :** Créez une nouvelle énigme avec une question, une réponse attendue, un message de succès et un message d'échec.
- **Répondre à une question :** Répondez à une énigme via un lien de partage et voyez si votre réponse est correcte.
- **Lister les questions :** Consultez toutes les énigmes disponibles avec leur taux de réussite.
- **Supprimer une question :** Supprimez une énigme de la base de données.

## Prérequis

- Serveur web (Apache, Nginx, etc.)
- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Git (optionnel)

## Installation

1. **Cloner le dépôt :**
   ```bash
   git clone https://github.com/godefroyhanot/partielPHP.git
   cd partielPHP
   ```

2. **Importer la base de données :**
   
   Importez le fichier `escape_game.sql` dans votre serveur MySQL pour créer la base de données et la table `questions`.

   Vous pouvez utiliser phpMyAdmin, MySQL Workbench ou la ligne de commande :
   ```bash
   mysql -u root -p escape_game < escape_game.sql
   ```

3. **Configurer la connexion à la base de données :**
   
   Copiez le fichier `db_connection.example.php` en `db_connection.php` :
   ```bash
   cp db_connection.example.php db_connection.php
   ```
   
   Modifiez `db_connection.php` avec vos identifiants de base de données :
   ```php
   <?php
   $host = "localhost"; // Votre hôte MySQL
   $dbname = "escape_game"; // Nom de la base de données
   $username = "root"; // Votre nom d'utilisateur MySQL
   $password = ""; // Votre mot de passe MySQL

   $conn = new mysqli($host, $username, $password, $dbname);

   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   ?>
   ```

4. **Lancer le serveur web :**
   
   Placez les fichiers dans le répertoire de votre serveur web (par exemple, `htdocs` pour XAMPP).
   
   Accédez à l'application via votre navigateur (par exemple, `http://localhost/partielPHP`).

## Utilisation

### Ajouter une question
1. Accédez à la page `add_question.php` (par exemple, `http://localhost/partielPHP/add_question.php`).
2. Remplissez le formulaire avec la question, la réponse attendue, le message de succès et le message d'échec.
3. Cliquez sur "Ajouter la question". Un lien de partage sera généré.

### Répondre à une question
1. Utilisez le lien de partage généré pour accéder à la page de réponse (par exemple, `http://localhost/partielPHP/answer_question.php?id=1`).
2. Répondez à la question dans le champ prévu et cliquez sur "Valider".
3. Le résultat sera affiché (message de succès ou d'échec).

### Lister les questions
1. Accédez à la page `index.php` (par exemple, `http://localhost/partielPHP/index.php`).
2. Vous verrez la liste des questions avec leur taux de réussite.
3. Vous pouvez supprimer une question en cliquant sur "Supprimer".

## Structure du projet
```bash
escape-game-php/
├── index.php                # Page d'accueil pour lister les questions
├── add_question.php         # Page pour ajouter une question
├── answer_question.php      # Page pour répondre à une question
├── delete_question.php      # Script pour supprimer une question
├── db_connection.php        # Fichier de connexion à la base de données (ignoré par Git)
├── db_connection.example.php # Exemple de fichier de connexion
├── escape_game.sql          # Export de la base de données
├── style.css                # Feuille de style CSS
└── README.md                # Ce fichier
```

## Technologies utilisées
- **PHP** : Langage de programmation côté serveur.
- **MySQL** : Base de données pour stocker les questions et les réponses.
- **HTML/CSS** : Structure et style des pages web.
- **Git** : Gestion de version.

## Auteur
**Godefroy Hanot** - Développeur du projet.

## Licence
Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.