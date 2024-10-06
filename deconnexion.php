<?php
session_start();
session_destroy();
echo "Déconnexion en cours..."; // Pour vérifier que le script s'exécute
header("Location: index.php"); // Rediriger vers la page d'accueil après déconnexion
exit();