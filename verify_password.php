
<?php
// Activer les erreurs PHP pour le développement

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);


// Vérifier la méthode POST

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

// Récupérer le mot de asse

$password = $_POST['password'] ?? '';


// Hachage du mot de passe attendu

$expectedHash = password_hash('PAS QUATTRE', PASSWORD_DEFAULT);



// Vérification du mot de passe

if (password_verify($password, $expectedHash)) {

// Retourner une réponse JSON pour mot de passe correct

echo json_encode(['success' => true, 'message' => 'Mot de passe correct !']);

} else {

// Retourner une réponse JSON pour mot de passe incorrect

echo json_encode(['success' => false, 'message' => 'Mot de passe incorrect.']);

}

exit;

}


// Si la méthode est incorrecte

http_response_code(405);

echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);

exit;
?>