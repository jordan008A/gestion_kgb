# Exercice STUDI - Gestion KGB

## Lien vers le site déployé
https://frozen-tor-84115-d5c5fe7420a6.herokuapp.com/

## Pour se connecter en tant qu'admin
- Email => james@bond.fr
- Mot de passe => studi2023

## Prérequis avant installation
- Installation de XAMPP et démarrage des modules Apache & MySQL.
- Installation de PHP.
- Installation de Composer qui est un gestionnaire de dépendances pour PHP.
- Mise en place d'un gestionnaire de base de données comme PhpMyAdmin.

## Pour éxécuter le site en local
- Clonage du Répertoire GitHub :
  ```
  git clone https://github.com/jordan008A/gestion_kgb.git
  ```
- Accès au Répertoire du Projet :
  ```
  cd gestion_kgb
  ```
- Renommez le fichier .env.example en .env

- Editez le fichier .env pour y ajouter les valeurs spécifiques à votre environnement

- Installation des dépendances :
  ```
  composer install
   ```
- Exécuter le script gestion_kgb_db.sql

- Utilisez la commande personnalisée pour créer un administrateur :
  ```
  php scripts/create_admin.php
  ``` 
  :information_source:
  > Laissez-vous guider par les différentes questions.
  > Existe aussi les commandes list_admin.php et delete_admin.php.

- Démarrage du Serveur Apache via XAMPP

## Technologies utilisées
- languages => PHP, Javascript et CSS
- Style => Boostrap
- Gestionnaires de dépendance => composer
- Système de gestion de base de données => Mysql
- Serveur web => Apache2