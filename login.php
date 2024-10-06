<?php include 'header.php'; ?>
<?php
// Démarrer la session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialisation des variables
$error = "";

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

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête pour récupérer l'utilisateur
    $sql = "SELECT * FROM utilisateurs WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Vérification du mot de passe
        if (password_verify($password, $user['password'])) {
            // Authentification réussie, démarrer la session
            $_SESSION['user_id'] = $user['id'];
            header("Location: index.php"); // Rediriger vers l'accueiltableau de bord
            exit();
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Utilisateur non trouvé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Page de Connexion</title>
    <style>
        .navbar {
            position: relative;
            z-index: 2;
            margin-bottom: 200px;
        }
        body {
            background-color: #f8f9fa; /* Couleur de fond */
            height: 100vh; /* Hauteur de la fenêtre */
        }
        .login-container {
            max-width: 400px; /* Largeur maximale du formulaire */
            margin: auto; /* Centrer le formulaire verticalement et horizontalement */
            height: auto;
            padding: 20px;
            background: white; /* Couleur de fond du formulaire */
            border-radius: 5px; /* Coins arrondis */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre */
        }
        .btn-primary {
            background-color: #6fbf92; /* Vert pâle */
            border-color: #6fbf92; /* Couleur de la bordure */
        }
        .btn-primary:hover {
            background-color: #5ba679; /* Couleur au survol */
            border-color: #5ba679; /* Couleur de la bordure au survol */
        }
        .alert {
            background-color: #e2f4e4; /* Vert pâle pour les messages d'erreur */
            color: #155724; /* Couleur du texte */
            border-color: #c3e6cb; /* Bordure du message */
        }
        .center_body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Hauteur de la fenêtre */
            margin: 0; /* Supprime la marge par défaut */
        }
    </style>
</head>
<body>
<div class="body">
    <div class="login-container">
        <h2 class="text-center">Se connecter</h2>
        
        <?php if ($error): ?>
            <div id="error-message" class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form id="login-form" method="POST" action="">
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
        </form>
        <div class="text-center mt-3">
            <a href="#">Mot de passe oublié ?</a>
        </div>
        <div class="text-center mt-3">
            <p>Pas encore inscrit ? <a href="inscription.php">Créer un compte</a></p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
