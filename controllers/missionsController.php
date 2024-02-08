<?php
require_once '../public/config/database.php';
require_once '../models/Agent.php';
require_once '../models/Contact.php';
require_once '../models/Cible.php';
require_once '../models/Planque.php';
require_once '../models/Specialite.php';
require_once '../models/Mission.php';
session_start();

$agentModel = new Agent();
$getAgents = $agentModel->getAll();

$contactModel = new Contact();
$getContacts = $contactModel->getAll();

$cibleModel = new Cible();
$getCibles = $cibleModel->getAll();

$planqueModel = new Planque();
$getPlanques = $planqueModel->getAll();

$specialiteModel = new Specialite();
$getSpecialites = $specialiteModel->getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $missionModel = new Mission();

    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $pays = $_POST['pays'];
    $type = $_POST['typeMission'];
    $statut = $_POST['statut'];
    $specialite = $_POST['specialite'];
    $agents = $_POST['agents'];
    $contacts = $_POST['contacts'];
    $cibles = $_POST['cibles'];
    $planques = $_POST['planques'];
    $dateDebut = $_POST['dateDebut'];

    $result = $missionModel->addMission($titre, $description, $pays, $type, $statut, $specialite, $agents, $contacts, $cibles, $planques, $dateDebut);

    if ($result) {
        $_SESSION['success_message'] = 'La mission a été ajoutée avec succès.';
        header('Location: /gestion_kgb/views/pages/missionsView.php');
    } else {
        $_SESSION['error_message'] = 'Échec de l\'ajout de la mission.';
        header('Location: /gestion_kgb/views/pages/addMissionView.php');
    }
    exit();
} else {
    $missions = [];
    require_once '../views/pages/addMissionView.php';
}
