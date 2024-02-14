<?php

namespace App\Controllers;

use App\Models\Cible;

class AdminCiblesController {
    public function index() {
        $cibleModel = new Cible();
        $cibles = $cibleModel->getAll();
        
        require_once BASE_PATH . '/app/views/admin/cibles.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cibleModel = new Cible();
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $dateNaissance = $_POST['dateNaissance'] ?? '';
            $nationalite = $_POST['nationalite'] ?? '';
            
            $success = $cibleModel->add($nom, $prenom, $dateNaissance, $nationalite);
            
            if ($success) {
                $_SESSION['success_message'] = 'La cible a été ajoutée avec succès.';
            } else {
                $_SESSION['error_message'] = 'Erreur lors de l\'ajout de la cible.';
            }
    
            header('Location: ' . BASE_URL . '/admin/cibles');
            exit();
        }
    }  

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cibleModel = new Cible();
            $id = $_POST['cibleId'];
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $dateNaissance = $_POST['dateNaissance'] ?? '';
            $nationalite = $_POST['nationalite'] ?? '';
    
            if ($cibleModel->update($id, $nom, $prenom, $dateNaissance, $nationalite)) {
                $_SESSION['success_message'] = 'La cible a été modifiée avec succès.';
            } else {
                $_SESSION['error_message'] = 'Erreur lors de la modification de la cible.';
            }
            header('Location: ' . BASE_URL . '/admin/cibles');
            exit();
        }
    }
  
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cibleModel = new Cible();
            $id = $_POST['cibleId'];
    
            $result = $cibleModel->delete($id);
    
            if ($result['success']) {
                $_SESSION['success_message'] = 'La cible a été supprimée avec succès.';
            } else {
                $_SESSION['error_message'] = $result['message'];
            }
    
            header('Location: ' . BASE_URL . '/admin/cibles');
            exit();
        }
    }

    public function details($cibleId) {
      $cibleModel = new Cible();
      $cibleDetails = $cibleModel->getById($cibleId);
  
      header('Content-Type: application/json');
      if ($cibleDetails) {
          echo json_encode(['success' => true, 'data' => $cibleDetails]);
      } else {
          echo json_encode(['success' => false, 'message' => 'Aucune cible trouvée.']);
      }
      exit;
  }
}
