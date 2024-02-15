<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\Models\Administrateur;


$email = $argv[1] ?? null;

if (empty($email)) {
    $email = readline("Veuillez entrer l'email de l'administrateur: ");
}

$adminModel = new Administrateur();

$result = $adminModel->delete($email);

if ($result) {
    echo "Administrateur supprimé avec succès.\n";
} else {
    echo "Erreur lors de la suppression de l'administrateur.\n";
}
