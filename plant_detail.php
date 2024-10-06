
<?php
if (!isset($_GET['id'])) {
    echo "ID de plante non spécifié.";
    exit;
}

$plantId = $_GET['id'];
$url = 'http://localhost:3000/plants/' . $plantId;

// Appel à votre serveur backend
$response = file_get_contents($url);

if ($response === FALSE) {
    echo "Erreur lors de la récupération des données.";
    exit;
}

$data = json_decode($response, true);

// Vérifiez si les données sont disponibles
if (!isset($data['main_species'])) {
    echo "Plante non trouvée.";
    exit;
}

$mainSpecies = $data['main_species'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($mainSpecies['common_name']); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/styles.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
    <h1 class="text-center display-4 mb-4"><?php echo htmlspecialchars($mainSpecies['common_name']); ?></h1>

        
        <h2>Images des fleurs:</h2>
        <div class="row">
            <?php if (!empty($data['flower_images'])): ?>
                <?php foreach ($data['flower_images'] as $image): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="<?php echo htmlspecialchars($image); ?>" class="card-img-top" alt="Image de <?php echo htmlspecialchars($mainSpecies['common_name']); ?>">
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune image de fleur disponible.</p>
            <?php endif; ?>
        </div>

        <p><strong>Nom scientifique:</strong> <?php echo htmlspecialchars($mainSpecies['scientific_name']); ?></p>
        <p><strong>Famille:</strong> <?php echo htmlspecialchars($mainSpecies['family']); ?></p>
        <p><strong>Genre:</strong> <?php echo htmlspecialchars($mainSpecies['genus']); ?></p>
        <p><strong>Auteur:</strong> <?php echo htmlspecialchars($mainSpecies['author']); ?></p>
        <p><strong>Année:</strong> <?php echo htmlspecialchars($mainSpecies['year']); ?></p>
        <p><strong>Bibliographie:</strong> <?php echo htmlspecialchars($mainSpecies['bibliography']); ?></p>


        <h2>Répartition des espèces à travers le monde:</h2>
        <?php if (!empty($data['distributions'])): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Pays</th>
                        <th>Nombre d'espèces</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['distributions'] as $dist): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($dist['name']); ?></td>
                            <td><?php echo htmlspecialchars($dist['species_count']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune répartition disponible.</p>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
