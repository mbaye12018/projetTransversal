<?php
// Vérifier si l'ID de l'utilisateur à supprimer est passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

// Récupérer l'ID de l'utilisateur à partir de l'URL
$user_id = $_GET['id'];

// Connexion à la base de données
$servername = "localhost";
$username = "hepatite_user";
$password = "passer";
$dbname = "hepatite";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si la suppression a été confirmée
if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    // Requête SQL pour supprimer l'utilisateur
    $sql = "DELETE FROM utilisateurs WHERE id_user=$user_id";

    if ($conn->query($sql) === TRUE) {
        // Redirection vers la page d'accueil après la suppression
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

// Requête SQL pour récupérer les informations de l'utilisateur à supprimer
$sql_select = "SELECT nom, prenom, email, roles FROM utilisateurs WHERE id_user=$user_id";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    // Récupérer les données de l'utilisateur
    $row = $result->fetch_assoc();
    $nom = $row['nom'];
    $prenom = $row['prenom'];
    $email = $row['email'];
    $roles = $row['roles'];
} else {
    echo "User not found";
    exit();
}

// Fermer la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User - Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="img/favicon.png">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<!-- Nice Select CSS -->
		<link rel="stylesheet" href="../css/nice-select.css">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="../css/font-awesome.min.css">
		<!-- icofont CSS -->
        <link rel="stylesheet" href="../css/icofont.css">
		<!-- Slicknav -->
		<link rel="stylesheet" href="../css/slicknav.min.css">
		<!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="../css/owl-carousel.css">
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="../css/datepicker.css">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="../css/animate.min.css">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="../css/magnific-popup.css">
		
		<!-- Medipro CSS -->
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../css/responsive.css">
</head>
<body>
    <header>
        <h1>supprimer Utilisateur - Admin Panel</h1>
    </header>
    <div class="container">
        <h2>Voulez vous supprimer cette utilisateur?</h2><br>
        <p><strong>Nom:</strong> <?php echo htmlspecialchars($nom); ?></p>
        <p><strong>Prénom:</strong> <?php echo htmlspecialchars($prenom); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Rôle:</strong> <?php echo htmlspecialchars($roles); ?></p><br>
        <div class="form-group">
            <a href="delete_user.php?id=<?php echo $user_id; ?>&confirm=yes" class="btn">Oui, supprimer</a><br>
            <a href="index.php" class="btn">Annuler</a>
        </div>
    </div>
    <footer>
        <p>Admin Panel &copy; 2024</p>
    </footer>
</body>
</html>
