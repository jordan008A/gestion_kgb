<?php

namespace App\Controllers;

use App\Models\Mission;

class AdminMissionsController {
    public function index() {
        $missionModel = new Mission();
        $missions = $missionModel->getAll();
        require_once BASE_PATH . '/app/Views/admin/missions.php';
    }

    public function changeStatus() {
        $missionId = $_POST['missionId'] ?? null;
        $newStatus = $_POST['newStatus'] ?? null;
        
        if ($missionId && $newStatus) {
            $missionModel = new Mission();
            $result = $missionModel->updateStatus($missionId, $newStatus);
            
            if ($result) {
                $_SESSION['success_message'] = "Le statut de la mission a été mis à jour avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de la mise à jour du statut de la mission.";
            }
        } else {
            $_SESSION['error_message'] = "Données de mise à jour du statut manquantes.";
        }
    
        header('Location: ' . BASE_URL . '/admin/missions');
        exit();
    }

    public function delete() {
        $missionId = $_POST['missionId'] ?? null;
        
        if ($missionId) {
            $missionModel = new Mission();
            $result = $missionModel->deleteMission($missionId);
            
            if ($result) {
                $_SESSION['success_message'] = "La mission a été supprimée avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de la suppression de la mission.";
            }
        } else {
            $_SESSION['error_message'] = "ID de la mission manquant pour la suppression.";
        }
    
        header('Location: ' . BASE_URL . '/admin/missions');
        exit();
    }
}
