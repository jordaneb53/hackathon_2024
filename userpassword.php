// stockage du mot de passe 

<?php
// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = "";
$dbname = "hackathon";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hacher le mot de passe
$plainPassword = "PAS QUATTRE"; // Le mot de passe à enregistrer
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

// Insérer le hash dans la table
$sql = "INSERT INTO userpassword (password) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $hashedPassword);

if ($stmt->execute()) {
    echo "Mot de passe hashé inséré avec succès.";
} else {
    echo "Erreur : " . $stmt->error;
}

$stmt->close();
$conn->close();
?>