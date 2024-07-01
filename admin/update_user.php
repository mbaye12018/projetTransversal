<?php
// Vérifier si l'ID de l'utilisateur à éditer est passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

// Récupérer l'ID de l'utilisateur à partir de l'URL
$user_id = $_GET['id'];

// Initialiser les variables pour stocker les données de l'utilisateur
$nom = $prenom = $email = $roles = '';

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

// Vérifier si le formulaire a été soumis pour mettre à jour l'utilisateur
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $roles = $_POST['roles'];

    // Requête SQL pour mettre à jour l'utilisateur
    $sql = "UPDATE utilisateurs SET nom='$nom', prenom='$prenom', email='$email', roles='$roles' WHERE id_user=$user_id";

    if ($conn->query($sql) === TRUE) {
        // Redirection vers la page d'accueil après la mise à jour
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

// Requête SQL pour récupérer les informations de l'utilisateur à éditer
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
    <title>Edit User - Admin Panel</title>
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
        <h1>Modifier Utilisateur- Admin Panel</h1>
    </header>
    <div class="container">
        <h2>Modifier Utilisateur</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $user_id; ?>" method="post">
            <div class="form-group">
                <input type="text" placeholder="Nom" id="nom" name="nom" value="<?php echo htmlspecialchars($nom); ?>" required>
            </div>
            <div class="form-group">
                <input type="text" placeholder="Prenom" id="prenom" name="prenom" value="<?php echo htmlspecialchars($prenom); ?>" required>
            </div>
            <div class="form-group">
                <input type="email" placeholder="Email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <select id="roles" name="roles" required>
                    <option value="admin" <?php if ($roles == 'admin') echo 'selected'; ?>>Admin</option>
                    <option value="utilisateur" <?php if ($roles == 'utilisateur') echo 'selected'; ?>>Utilisateur</option>
                    <option value="ministere" <?php if ($roles == 'ministere') echo 'selected'; ?>>Ministère</option>
                    <option value="laborantin" <?php if ($roles == 'laborantin') echo 'selected'; ?>>Laborantin</option>
                </select>
            </div>
            <button type="submit" class="btn">Modifier</button>
            <a href="index.php" class="btn">Annuler</a>
        </form>
    </div>
    <footer>
        <p>Admin Panel &copy; 2024</p>
    </footer>
</body>
</html>
