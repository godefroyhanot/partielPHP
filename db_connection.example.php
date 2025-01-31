<?php
// db_connection.example.php
$host = "votre_hôte";
$dbname = "votre_base_de_données";
$username = "votre_utilisateur";
$password = "votre_mot_de_passe";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>