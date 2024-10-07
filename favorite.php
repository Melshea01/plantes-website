<?php

include 'header.php'; // Inclure le header
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
$host = 'localhost';
$db = 'plantes'; // Nom de ta base de données
$user = 'root'; // Utilisateur par défaut de XAMPP
$pass = ''; // Mot de passe par défaut de XAMPP

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirige vers la page de connexion si non connecté
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupération des fleurs préférées de l'utilisateur
$query = "SELECT plant_id FROM favoris WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$favorites = $result->fetch_all(MYSQLI_ASSOC);

$favorites_details = [];

// Récupérer les informations des fleurs via l'API
if ($favorites) {
    foreach ($favorites as $flower) {
        $plant_id = $flower['plant_id'];
        $api_url = "http://localhost:3000/plants/$plant_id"; // Assurez-vous que l'URL est correcte
        $response = file_get_contents($api_url);
        if ($response !== false) {
            $favorites_details[] = json_decode($response, true);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Mes plantes préférées</h2>
        <div class="row">
            <?php if ($favorites_details): ?>
                <?php foreach ($favorites_details as $flower): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo htmlspecialchars($flower['main_species']['image_url'] ?? 'default_image_url.jpg'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($flower['main_species']['common_name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($flower['main_species']['common_name']); ?></h5>
                                <p><strong>Nom scientifique:</strong> <?php echo htmlspecialchars($flower['main_species']['scientific_name']); ?></p>
                                <p><strong>Famille:</strong> <?php echo htmlspecialchars($flower['main_species']['family']); ?></p>
                                <p><strong>Genre:</strong> <?php echo htmlspecialchars($flower['main_species']['genus']); ?></p>
                                <p><strong>Auteur:</strong> <?php echo htmlspecialchars($flower['main_species']['author']); ?></p>
                                <p><strong>Année:</strong> <?php echo htmlspecialchars($flower['main_species']['year']); ?></p>
                                <p><strong>Bibliographie:</strong> <?php echo htmlspecialchars($flower['main_species']['bibliography']); ?></p>
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="plant_detail.php?id=<?php echo htmlspecialchars($plant_id); ?>" class="btn btn-light-green">Voir les détails</a>
                                    <form action="supprimer_favorite.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="plant_id" value="<?php echo htmlspecialchars($plant_id); ?>">
                                        <button type="submit" class="btn btn-danger">Supprimer des favoris</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune fleur préférée trouvée.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php include 'footer.php'; ?>