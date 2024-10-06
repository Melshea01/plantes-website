<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiteWeb sur les plantes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset\css\styles.css">

</head>


<body>
    <div class="container mt-4 ">
        <h2 class="text-center  mt-5 mb-5">Découvrez les différents types de plantes</h2>
        <div class="row">
            <div class="row">
                <?php
                // Effectuer une requête GET vers le serveur Node.js
                $url = 'http://localhost:3000/plants/all'; // Assurez-vous que l'URL correspond à votre serveur
                $response = file_get_contents($url);
                $plants = json_decode($response, true);

                // Vérifiez si des plantes ont été récupérées
                if ($plants) {
                    foreach ($plants as $plant) {

                        echo '<div class="col-md-4 mb-4">';
                        echo '<div class="card-flip">';
                        echo '<div class="card">';
                        echo '<div class="card-front">';
                        echo '<img src="' . htmlspecialchars($plant['image_url']) . '" class="card-img-top" alt="' . htmlspecialchars($plant['common_name']) . '" />';
                        echo '<div class="card-body">';
                        echo '</div></div>';
                        echo '<div class="card-back">';
                        echo '<div class="card-body">';
                        echo '<div class="d-flex align-items-center">'; // Conteneur flex pour le titre et l'icône
                        echo '<h5 class="card-title mb-0 mr-2">' . htmlspecialchars($plant['common_name']) . '</h5>'; // Titre de la carte

                        // Vérifier si l'utilisateur est connecté
                        if (isset($_SESSION['user_id'])) {
                            // Bouton étoile
                            echo '<form method="POST" action="ajouter_favori.php" class="mb-0">'; // Pas de marge en bas
                            echo '<input type="hidden" name="plant_id" value="' . htmlspecialchars($plant['id']) . '">';
                            echo '<button type="submit" class="btn btn-link p-0">'; // Bouton sans marge
                            echo '<i class="fas fa-star" style="color: grey;"></i>';
                            echo '</button>';
                            echo '</form>';
                        }
                        echo '</div>'; // Fin du conteneur flex
                        echo '<p class="card-text">Cliquez pour voir les détails !</p>';
                        echo '<a href="plant_detail.php?id=' . htmlspecialchars($plant['id']) . '" class="btn btn-light-green">Voir les détails</a>';

                        echo '</div></div>';
                        echo '</div></div>';
                        echo '</div>';
                    }
                } else {
                    echo "Aucune plante trouvée.";
                }
                ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</body>

<?php include 'footer.php'; ?>