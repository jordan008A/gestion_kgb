<?php

namespace App\Controllers;

use App\Models\Agent;
use App\Models\Contact;
use App\Models\Cible;
use App\Models\Planque;
use App\Models\Specialite;
use App\Models\Mission;

class MissionsController {
    public function index() {
        $missionModel = new Mission();
        $missions = $missionModel->getAll();
        require_once BASE_PATH . '/app/views/missions/index.php';
    }

    public function details($nomCode) {
        $missionModel = new Mission();
        $missionDetails = $missionModel->getByNomCode($nomCode);
        require_once BASE_PATH . '/app/views/missions/details.php';
    }
    

    public function add() {

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
        
        require_once BASE_PATH . '/app/views/missions/add.php';
    }

    public function store() {
        
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $pays = htmlspecialchars($_POST['pays']);
        $type = htmlspecialchars($_POST['typeMission']);
        $statut = htmlspecialchars($_POST['statut']);
        $specialite = htmlspecialchars($_POST['specialite']);
    
        $errors = [];
        if (empty($titre)) $errors[] = 'Le titre est requis.';
        if (empty($description)) $errors[] = 'La description est requise.';
        if (empty($pays)) $errors[] = 'Le pays est requis.';
        if (empty($type)) $errors[] = 'Le type de mission est requis.';
        if (empty($statut)) $errors[] = 'Le statut est requis.';
        if (empty($specialite)) $errors[] = 'La spécialité est requise.';
    
        if (!empty($errors)) {
        $_SESSION['error_messages'] = $errors;
        header('Location: ' . BASE_URL . '/missions/add');
        exit();
    }

    $missionModel = new Mission;
    $result = $missionModel->addMission($titre, $description, $pays, $type, $statut, $specialite, $_POST['agents'], $_POST['contacts'], $_POST['cibles'], $_POST['planques'], $_POST['dateDebut']);
    
    if ($result['success']) {
        $_SESSION['success_message'] = 'La mission a été ajoutée avec succès.';
        header('Location: ' . BASE_URL . '/missions');
        exit();
    } else {
        error_log('Échec de l\'ajout de la mission : ' . $result['message']);
        $_SESSION['error_message'] = 'Échec de l\'ajout de la mission : ' . $result['message'];
        header('Location: ' . BASE_URL . '/missions/add');
        exit();
    }
    }
}
