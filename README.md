# Plantes En Ligne

Une plateforme dédiée aux passionnés de botanique, permettant d'explorer différents types de plantes et d'accéder à des informations détaillées.

![image](https://github.com/user-attachments/assets/c19704f8-bcd3-420f-ba5c-15599b1e0a36)

## Introduction

Plantes En Ligne est un site web interactif où les utilisateurs peuvent découvrir une variété de plantes grâce à des images récupérées via l'API [trefle.io](https://trefle.io). Les utilisateurs peuvent également obtenir des informations détaillées sur la répartition des espèces dans le monde et sauvegarder leurs plantes préférées après s'être connectés.

## Fonctionnalités

- **Explorer les plantes** : Visualisez différents types de plantes avec des images provenant de l'API trefle.io.
 ![image](https://github.com/user-attachments/assets/e0ad3e43-f7d7-4276-b32b-d7241542979a)
- **Informations détaillées** : Accédez à des données sur la répartition des espèces dans le monde.
- **Connexion utilisateur** : Créez un compte pour sauvegarder vos plantes préférées et les gérer facilement.


## Technologies utilisées

- **HTML5 & CSS 3 & Bootstrap** : Pour la structure du site.
- **Express** : Pour le serveur et la gestion des requêtes entre le site et l'API trefle.io.
- **MySQL** : Pour stocker les informations des utilisateurs.
- **API trefle.io** : Pour récupérer des informations sur les plantes.
- **PHP** : Pour gérer les sessions utilisateurs.
## Installation

Instructions pour cloner le projet et l'installer localement :

1. **Téléchargez et installez XAMPP** :
   - [Télécharger XAMPP](https://www.apachefriends.org/index.html)

2. **Clonez le projet** :
   ```bash
   git clone https://github.com/ton-utilisateur/plantes-en-ligne.git

3. **Déplacez le projet dans le dossier htdocs de XAMPP** :

Copiez le dossier plantes-en-ligne dans le répertoire C:\xampp\htdocs\.
4. **Configurez la base de données** :
Lancez XAMPP et démarrez les modules Apache et MySQL.
Ouvrez votre navigateur et accédez à http://localhost/phpmyadmin.
Créez une nouvelle base de données pour le projet.
Importez le fichier de copie de la base de données via l'interface de phpMyAdmin.

5. **Lancer le serveur en back**

## Futures améliorations 

- Ajout d'une carte monde pour visualiser les différentes espèces
- Ajout d'un onglet "famille" pour voir les différentes familles
- Rechercher les plantes par leurs noms 
