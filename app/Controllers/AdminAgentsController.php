<?php

namespace App\Controllers;

use App\Models\Agent;
use App\Models\Specialite;

class AdminAgentsController {
    public function index() {
        $agentModel = new Agent();
        $agents = $agentModel->getAll();
        
        $specialiteModel = new Specialite();
        $specialites = $specialiteModel->getAll();
        
        require_once BASE_PATH . '/app/views/admin/agents.php';
    }

    public function create() {

        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['error_message'] = 'Erreur de validation. Veuillez réessayer.';
                header('Location: ' . BASE_URL . '/404');
                exit();
            }
            $agentModel = new Agent();
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $dateNaissance = $_POST['dateNaissance'] ?? '';
            $nationalite = $_POST['nationalite'] ?? '';
            $specialites = $_POST['specialites'] ?? [];
            
            $success = $agentModel->add($nom, $prenom, $dateNaissance, $nationalite, $specialites);
            
            if ($success) {
                $_SESSION['success_message'] = 'L\'agent a été ajouté avec succès.';
            } else {
                $_SESSION['error_message'] = 'Erreur lors de l\'ajout de l\'agent.';
            }
    
            header('Location: ' . BASE_URL . '/admin/agents');
            exit();
        }
    }  

    public function edit() {

        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['error_message'] = 'Erreur de validation. Veuillez réessayer.';
                header('Location: ' . BASE_URL . '/404');
                exit();
            }
            $agentModel = new Agent();
            $id = $_POST['agentId'];
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $dateNaissance = $_POST['dateNaissance'] ?? '';
            $nationalite = $_POST['nationalite'] ?? '';
    
            if ($agentModel->update($id, $nom, $prenom, $dateNaissance, $nationalite)) {
                $agentModel->deleteSpecialites($id);

                $specialites = $_POST['specialites'] ?? [];
                if (!empty($specialites)) {
                    foreach ($specialites as $specialite) {
                        $agentModel->addSpecialite($id, $specialite);
                    }
                  }
                $_SESSION['success_message'] = 'L\'agent a été modifié avec succès.';
            } else {
                $_SESSION['error_message'] = 'Erreur lors de la modification de l\'agent.';
            }
            header('Location: ' . BASE_URL . '/admin/agents');
            exit();
        }
    }
  
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $agentModel = new Agent();
            $id = $_POST['agentId'];
    
            $result = $agentModel->delete($id);
    
            if ($result['success']) {
                $_SESSION['success_message'] = 'L\'agent a été supprimé avec succès.';
            } else {
                $_SESSION['error_message'] = $result['message'];
            }
    
            header('Location: ' . BASE_URL . '/admin/agents');
            exit();
        }
    }

    public function details($agentId) {
      $agentModel = new Agent();
      $agentDetails = $agentModel->getById($agentId);
      $specialites = $agentModel->getSpecialitesByAgentId($agentId);
  
      header('Content-Type: application/json');
      if ($agentDetails) {
          $agentDetails['specialites'] = $specialites;
          echo json_encode(['success' => true, 'data' => $agentDetails]);
      } else {
          echo json_encode(['success' => false, 'message' => 'Aucun agent trouvé.']);
      }
      exit;
  }
}
