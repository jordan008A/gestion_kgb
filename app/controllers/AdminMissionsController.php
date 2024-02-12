<?php

namespace App\Controllers;

use App\Models\Mission;

class AdminMissionsController {
    public function index() {
        $missionModel = new Mission();
        $missions = $missionModel->getAll();
        require_once BASE_PATH . '/app/views/admin/missions/index.php';
    }

    public function changeStatus() {
        // Logique pour changer le statut ou terminer la mission
        // Récupérez les données nécessaires (ID de la mission, nouveau statut, etc.) via $_POST ou $_GET
    }

    public function delete() {
        // Logique pour supprimer une mission
        // Récupérez l'ID de la mission via $_POST ou $_GET
    }
}
