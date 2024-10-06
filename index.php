<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@700&display=swap" rel="stylesheet"> <!-- Ajout de la police Zilla Slab -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-image: url('asset/images/landing_page.jpg');
            background-size: cover;
            background-position: center;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            z-index: 1;
        }
        .navbar {
            position: relative;
            z-index: 2;
        }
        .welcome-text {
            font-family: 'Zilla Slab', serif; /* Appliquer la police Zilla Slab */
            font-size: 3rem; /* Agrandir le texte */
        }
        .btn-pale-green {
            background-color: #a8e6cf;
            color: #000;
        }
        .btn-pale-green:hover {
            background-color: #81d4ba;
        }
        footer {
    position: relative; /* Permet de le placer normalement dans le flux */
    z-index: 2; /* Assure que le footer est au-dessus de l'overlay */
}

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Assure que le corps prend au moins toute la hauteur de la fenêtre */
    }

    .overlay {
        flex: 1; /* Permet à l'overlay de prendre l'espace restant */
    }

    </style>
</head>
<body>
    <div class="overlay">
        <div class="text-center">
            <h1 class="welcome-text">Bienvenue sur notre Landing Page</h1> <!-- Classe ajoutée ici -->
            <p>Découvrez nos offres exceptionnelles.</p>
            <a href="plant_page.php" class="btn btn-pale-green">En savoir plus</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>


</html>

<?php include 'footer.php'; ?>