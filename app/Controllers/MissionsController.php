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
        require_once BASE_PATH . '/app/Views/missions/index.php';
    }

    public function details($nomCode) {
        $missionModel = new Mission();
        $missionDetails = $missionModel->getByNomCode($nomCode);
        require_once BASE_PATH . '/app/Views/missions/details.php';
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
        
        require_once BASE_PATH . '/app/Views/missions/add.php';
    }

    public function store() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['error_message'] = 'Erreur de validation. Veuillez réessayer.';
                header('Location: ' . BASE_URL . '/missions/add');
                exit();
            }
    
            $missionData = [
                'titre' => htmlspecialchars($_POST['titre']),
                'description' => htmlspecialchars($_POST['description']),
                'pays' => htmlspecialchars($_POST['pays']),
                'type' => htmlspecialchars($_POST['typeMission']),
                'statut' => htmlspecialchars($_POST['statut']),
                'specialite' => htmlspecialchars($_POST['specialite']),
                'dateDebut' => $_POST['dateDebut'],
            ];
            $agents = $_POST['agents'] ?? [];
            $contacts = $_POST['contacts'] ?? [];
            $cibles = $_POST['cibles'] ?? [];
            $planques = $_POST['planques'] ?? [];
    
            $errors = $this->validateMissionData($missionData, $agents, $contacts, $cibles, $planques);
    
            if (!empty($errors)) {
                $_SESSION['error_messages'] = $errors;
                header('Location: ' . BASE_URL . '/missions/add');
                exit();
            }
    
            $missionModel = new Mission();
            $result = $missionModel->addMission(
                $missionData['titre'],
                $missionData['description'],
                $missionData['pays'],
                $missionData['type'],
                $missionData['statut'],
                $missionData['specialite'],
                $agents,
                $contacts,
                $cibles,
                $planques,
                $missionData['dateDebut']
            );
    
            if ($result['success']) {
                $_SESSION['success_message'] = 'La mission a été ajoutée avec succès.';
                header('Location: ' . BASE_URL . '/missions');
                exit();
            } else {
                $_SESSION['error_message'] = 'Échec de l\'ajout de la mission : ' . $result['message'];
                header('Location: ' . BASE_URL . '/missions/add');
                exit();
            }
        }
    }
    

    private function validateMissionData($missionData, $agents, $contacts, $cibles, $planques) {
        $errors = [];
    
        foreach ($agents as $agentId) {
            $agent = (new Agent())->getById($agentId);
            foreach ($cibles as $cibleId) {
                $cible = (new Cible())->getById($cibleId);
                if ($agent['Nationalite'] === $cible['Nationalite']) {
                    $errors[] = "Les agents et les cibles ne peuvent pas avoir la même nationalité.";
                    break 2;
                }
            }
        }
    
        foreach ($contacts as $contactId) {
            $contact = (new Contact())->getById($contactId);
            if ($contact['Pays'] !== $missionData['pays']) {
                $errors[] = "Les contacts doivent être de la nationalité du pays de la mission.";
                break;
            }
        }
    
        foreach ($planques as $planqueId) {
            $planque = (new Planque())->getById($planqueId);
            if ($planque['Pays'] !== $missionData['pays']) {
                $errors[] = "Les planques doivent être dans le même pays que la mission.";
                break;
            }
        }
    
        foreach ($agents as $agentId) {
            $agentSpecialites = (new Agent())->getSpecialitesByAgentId($agentId);
            if (!in_array($missionData['specialite'], $agentSpecialites)) {
                $specialiteRequired = false;
            } else {
                $specialiteRequired = true;
                break;
            }
        }
        if (!$specialiteRequired) {
            $errors[] = "Au moins un agent avec la spécialité requise doit être assigné à la mission.";
        }

        return $errors;
    }
    
}
