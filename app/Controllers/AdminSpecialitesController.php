<?php

namespace App\Controllers;

use App\Models\Specialite;

class AdminSpecialitesController {
    public function index() {
        $specialiteModel = new Specialite();
        $specialites = $specialiteModel->getAll();
        
        require_once BASE_PATH . '/app/Views/admin/specialites.php';
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
            $specialiteModel = new Specialite();
            $nom = $_POST['nom'] ?? '';
            
            $success = $specialiteModel->add($nom);
            
            if ($success) {
                $_SESSION['success_message'] = 'La spécialité a été ajoutée avec succès.';
            } else {
                $_SESSION['error_message'] = 'Erreur lors de l\'ajout de la spécialité.';
            }
    
            header('Location: ' . BASE_URL . '/admin/specialites');
            exit();
        }
    }
  
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $specialiteModel = new Specialite();
            $nom = $_POST['nom'];
    
            $result = $specialiteModel->delete($nom);
    
            if ($result['success']) {
                $_SESSION['success_message'] = 'La spécialité a été supprimée avec succès.';
            } else {
                $_SESSION['error_message'] = $result['message'];
            }
    
            header('Location: ' . BASE_URL . '/admin/specialites');
            exit();
        }
    }
}
