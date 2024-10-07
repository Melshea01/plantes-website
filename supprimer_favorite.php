<?php
session_start();

// Connexion à la base de données
$host = 'localhost';
$db = 'plantes';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['plant_id'])) {
    $plant_id = $_POST['plant_id'];

    // Préparer la requête pour supprimer le favori

    $query = "DELETE FROM favoris WHERE user_id = ? AND plant_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $plant_id);
    
    if ($stmt->execute()) {
        // Redirection après suppression
        header("Location: favorite.php"); // Redirige vers le tableau de bord
        exit();
    } else {
        echo "Erreur lors de la suppression.";
    }
}

$conn->close();
?>
