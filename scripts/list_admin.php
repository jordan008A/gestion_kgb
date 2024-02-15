<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\Models\Administrateur;

$adminModel = new Administrateur();
$admins = $adminModel->getAll();

echo "Liste des administrateurs :\n";
foreach ($admins as $admin) {
    echo "ID: " . $admin['AdresseMail'] . " | Nom: " . $admin['Nom'] . " " . $admin['Prenom'] . "\n";
}
