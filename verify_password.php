// vérification du password hashé 

<?php
header('Content-Type: application/json');

// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = "";
$dbname = "hackathon";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Erreur de connexion à la base de données.']));
}

// Récupérer l'entrée utilisateur
$userInput = $_POST['password'] ?? '';

if (empty($userInput)) {
    echo json_encode(['success' => false, 'message' => 'Mot de passe requis.']);
    exit;
}

// Récupérer le hash depuis la base de données
$sql = "SELECT password FROM userpassword LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password'];

    // Vérifier le mot de passe
    if (password_verify($userInput, $hashedPassword)) {
        echo json_encode(['success' => true, 'message' => '✅ Correct ! Bien joué.']);
    } else {
        echo json_encode(['success' => false, 'message' => '❌ Incorrect, essayez encore.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Mot de passe introuvable.']);
}

$conn->close();
?>