<?php

namespace App\Controllers;

use App\Models\Planque;

class AdminPlanquesController {
    public function index() {
        $planqueModel = new Planque();
        $planques = $planqueModel->getAll();
        
        require_once BASE_PATH . '/app/views/admin/planques.php';
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
            $planqueModel = new Planque();
            $adresse = $_POST['adresse'] ?? '';
            $pays = $_POST['pays'] ?? '';
            $type = $_POST['type'] ?? '';
            
            $success = $planqueModel->add($adresse, $pays, $type);
            
            if ($success) {
                $_SESSION['success_message'] = 'La planque a été ajoutée avec succès.';
            } else {
                $_SESSION['error_message'] = 'Erreur lors de l\'ajout de la planque.';
            }
    
            header('Location: ' . BASE_URL . '/admin/planques');
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
            $planqueModel = new Planque();
            $id = $_POST['planqueId'];
            $adresse = $_POST['adresse'] ?? '';
            $pays = $_POST['pays'] ?? '';
            $type = $_POST['type'] ?? '';
    
            if ($planqueModel->update($id, $adresse, $pays, $type)) {
                $_SESSION['success_message'] = 'La planque a été modifiée avec succès.';
            } else {
                $_SESSION['error_message'] = 'Erreur lors de la modification de la planque.';
            }
            header('Location: ' . BASE_URL . '/admin/planques');
            exit();
        }
    }
  
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $planqueModel = new Planque();
            $id = $_POST['planqueId'];
    
            $result = $planqueModel->delete($id);
    
            if ($result['success']) {
                $_SESSION['success_message'] = 'La planque a été supprimée avec succès.';
            } else {
                $_SESSION['error_message'] = $result['message'];
            }
    
            header('Location: ' . BASE_URL . '/admin/planques');
            exit();
        }
    }

    public function details($planqueId) {
      $planqueModel = new Planque();
      $planqueDetails = $planqueModel->getById($planqueId);
  
      header('Content-Type: application/json');
      if ($planqueDetails) {
          echo json_encode(['success' => true, 'data' => $planqueDetails]);
      } else {
          echo json_encode(['success' => false, 'message' => 'Aucune planque trouvée.']);
      }
      exit;
  }
}
