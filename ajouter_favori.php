<?php
session_start(); // Démarrer la session

// Connexion à la base de données
$host = 'localhost';
$db = 'plantes'; // Nom de ta base de données
$user = 'root'; // Utilisateur par défaut de XAMPP
$pass = ''; // Mot de passe par défaut de XAMPP

$conn = new mysqli($host, $user, $pass, $db);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $plant_id = $_POST['plant_id']; // ID de la plante récupéré du formulaire

    // Vérifier si la plante est déjà dans les favoris
    $sql_check = "SELECT * FROM favoris WHERE user_id = ? AND plant_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param('ii', $user_id, $plant_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows == 0) {
        // Ajouter la plante aux favoris
        $sql = "INSERT INTO favoris (user_id, plant_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $user_id, $plant_id);
        if ($stmt->execute()) {
            echo "Plante ajoutée aux favoris avec succès.";
        } else {
            echo "Erreur lors de l'ajout aux favoris.";
        }
    } else {
        echo "Cette plante est déjà dans vos favoris.";
    }
} else {
    echo "Veuillez vous connecter pour ajouter des favoris.";
}

// Fermer la connexion
$stmt_check->close();
$conn->close();
?>
