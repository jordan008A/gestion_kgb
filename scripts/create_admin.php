<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\Models\Administrateur;


$nom = $argv[1] ?? null;
$prenom = $argv[2] ?? null;
$email = $argv[3] ?? null;
$password = $argv[4] ?? null;

if (empty($nom)){
  $nom = readline("Veuillez entrer le nom de l'administrateur: ");
}

if (empty($prenom)){
  $prenom = readline("Veuillez entrer le prénom de l'administrateur: ");
}

if (empty($email)) {
    $email = readline("Veuillez entrer l'email de l'administrateur: ");
}

if (empty($password)) {
    $password = readline("Veuillez entrer le mot de passe de l'administrateur: ");
}

$adminModel = new Administrateur();
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$result = $adminModel->createAdmin($nom, $prenom, $email, $hashedPassword);

if ($result) {
    echo "Administrateur créé avec succès.\n";
} else {
    echo "Erreur lors de la création de l'administrateur.\n";
}
