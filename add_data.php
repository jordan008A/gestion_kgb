<?php
require_once 'public/config/database.php';

$db = new mysqli("localhost", "root", "", "gestion_kgb_db");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$db->query("INSERT INTO agents (CodeID, Nom, Prenom, DateNaissance, Nationalite) VALUES (UUID(), 'Doe', 'John', '1980-01-01', 'Française'), (UUID(), 'Smith', 'Jane', '1985-02-02', 'Britannique');");

$db->query("INSERT INTO contacts (NomCode, Nom, Prenom, DateNaissance, Nationalite) VALUES (UUID(), 'Dupont', 'Marie', '1990-03-03', 'Française'), (UUID(), 'Doe', 'Alice', '1992-04-04', 'Américaine');");

$db->query("INSERT INTO cibles (NomCode, Nom, Prenom, DateNaissance, Nationalite) VALUES (UUID(), 'Rogue', 'Alex', '1975-05-05', 'Russe'), (UUID(), 'Mystery', 'Eve', '1980-06-06', 'Canadienne');");

$db->query("INSERT INTO planques (Code, Adresse, Pays, Type) VALUES (UUID(), '123 Rue Imaginaire', 'France', 'Appartement'), (UUID(), '456 Avenue Fiction', 'Royaume-Uni', 'Maison');");

$db->query("INSERT INTO specialites (Nom) VALUES ('Informatique'), ('Surveillance');");

$agentIds = $db->query("SELECT CodeID FROM agents");
$specialiteNom = $db->query("SELECT Nom FROM specialites WHERE Nom = 'Informatique'");

if ($agentIds && $specialiteNom) {
    $specialiteNom = $specialiteNom->fetch_assoc()['Nom'];
    
    while ($agentId = $agentIds->fetch_assoc()) {
        $db->query("INSERT INTO Agent_Specialite (AgentCodeID, SpecialiteNom) VALUES ('{$agentId['CodeID']}', '$specialiteNom')");
    }
}

if ($db->error) {
    echo "Erreur lors de l'insertion : " . $db->error;
} else {
    echo "Insertion des données factices réussie.\n";
}

$db->close();
