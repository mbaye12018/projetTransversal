<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Users</title>
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
        <h1>Admin Panel - Users</h1>
    </header>
    <div class="container">
        <div class="top">
            <a href="create_user.html" class="btn">Ajouter User</a>
            <form action="index.php" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Recherche...">
                <button type="submit" class="btn">Rechercher</button>
            </form>
        </div>
        <h2>User List</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
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
                
                // Requête SQL pour récupérer les utilisateurs
                $sql = "SELECT id_user, nom, prenom, email, roles FROM utilisateurs";
                
                // Gestion de la recherche
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $search = $_GET['search'];
                    $sql .= " WHERE nom LIKE '%$search%' OR prenom LIKE '%$search%' OR email LIKE '%$search%'";
                }
                
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    // Affichage des données trouvées
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nom"] . "</td>";
                        echo "<td>" . $row["prenom"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["roles"] . "</td>";
                        echo "<td>";
                        echo '<a href="update_user.php?id=' . $row["id_user"] . '" class="btn">Edit</a>';
                        echo '<span class="btn-space"></span>'; // Espace entre les boutons
                        echo '<a href="delete_user.php?id=' . $row["id_user"] . '" class="btn">Delete</a>';
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found</td></tr>";
                }
                
                // Fermer la connexion
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>Admin Panel &copy; 2024</p>
    </footer>
    <!-- jquery Min JS -->
    <script src="../js/jquery.min.js"></script>
		<!-- jquery Migrate JS -->
		<script src="../js/jquery-migrate-3.0.0.js"></script>
		<!-- jquery Ui JS -->
		<script src="../js/jquery-ui.min.js"></script>
		<!-- Easing JS -->
        <script src="../js/easing.js"></script>
		<!-- Color JS -->
		<script src="../js/colors.js"></script>
		<!-- Popper JS -->
		<script src="../js/popper.min.js"></script>
		<!-- Bootstrap Datepicker JS -->
		<script src="../js/bootstrap-datepicker.js"></script>
		<!-- Jquery Nav JS -->
        <script src="../js/jquery.nav.js"></script>
		<!-- Slicknav JS -->
		<script src="../js/slicknav.min.js"></script>
		<!-- ScrollUp JS -->
        <script src="../js/jquery.scrollUp.min.js"></script>
		<!-- Niceselect JS -->
		<script src="../js/niceselect.js"></script>
		<!-- Tilt Jquery JS -->
		<script src="../js/tilt.jquery.min.js"></script>
		<!-- Owl Carousel JS -->
        <script src="../js/owl-carousel.js"></script>
		<!-- counterup JS -->
		<script src="../js/jquery.counterup.min.js"></script>
		<!-- Steller JS -->
		<script src="../js/steller.js"></script>
		<!-- Wow JS -->
		<script src="../js/wow.min.js"></script>
		<!-- Magnific Popup JS -->
		<script src="../js/jquery.magnific-popup.min.js"></script>
		<!-- Counter Up CDN JS -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="../js/bootstrap.min.js"></script>
		<!-- Main JS -->
		<script src="../js/main.js"></script>
</body>
</html>
