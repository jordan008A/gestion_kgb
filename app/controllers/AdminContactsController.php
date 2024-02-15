<?php

namespace App\Controllers;

use App\Models\Contact;

class AdminContactsController {
    public function index() {
        $contactModel = new Contact();
        $contacts = $contactModel->getAll();
        
        require_once BASE_PATH . '/app/views/admin/contacts.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactModel = new Contact();
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $dateNaissance = $_POST['dateNaissance'] ?? '';
            $nationalite = $_POST['nationalite'] ?? '';
            
            $success = $contactModel->add($nom, $prenom, $dateNaissance, $nationalite);
            
            if ($success) {
                $_SESSION['success_message'] = 'Le contact a été ajouté avec succès.';
            } else {
                $_SESSION['error_message'] = 'Erreur lors de l\'ajout du contact.';
            }
    
            header('Location: ' . BASE_URL . '/admin/contacts');
            exit();
        }
    }  

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactModel = new Contact();
            $id = $_POST['contactId'];
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $dateNaissance = $_POST['dateNaissance'] ?? '';
            $nationalite = $_POST['nationalite'] ?? '';
    
            if ($contactModel->update($id, $nom, $prenom, $dateNaissance, $nationalite)) {
                $_SESSION['success_message'] = 'Le contact a été modifié avec succès.';
            } else {
                $_SESSION['error_message'] = 'Erreur lors de la modification du contact.';
            }
            header('Location: ' . BASE_URL . '/admin/contacts');
            exit();
        }
    }
  
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactModel = new Contact();
            $id = $_POST['contactId'];
    
            $result = $contactModel->delete($id);
    
            if ($result['success']) {
                $_SESSION['success_message'] = 'Le contact a été supprimé avec succès.';
            } else {
                $_SESSION['error_message'] = $result['message'];
            }
    
            header('Location: ' . BASE_URL . '/admin/contacts');
            exit();
        }
    }

    public function details($contactId) {
      $contactModel = new Contact();
      $contactDetails = $contactModel->getById($contactId);
  
      header('Content-Type: application/json');
      if ($contactDetails) {
          echo json_encode(['success' => true, 'data' => $contactDetails]);
      } else {
          echo json_encode(['success' => false, 'message' => 'Aucun contact trouvé.']);
      }
      exit;
  }
}
