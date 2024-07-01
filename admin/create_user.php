<?php
$servername = "localhost";
$username = "hepatite_user";
$password = "passer";
$dbname = "hepatite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
$roles = $_POST['roles'];

$sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, roles) VALUES ('$nom', '$prenom', '$email', '$mot_de_passe', '$roles')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "New user created successfully. User ID: " . $last_id . "<br>";
    echo "Name: " . $nom . " " . $prenom . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Role: " . $roles . "<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
