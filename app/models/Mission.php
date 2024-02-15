<?php
namespace App\Models;

use Exception;

class Mission extends Model {
    public function getAll() {
        $sql = "SELECT * FROM missions";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getByNomCode($nomCode) {
        $stmt = $this->db->prepare("SELECT * FROM missions WHERE NomCode = ?");
        $stmt->bind_param("s", $nomCode);
        $stmt->execute();
        $mission = $stmt->get_result()->fetch_assoc();
    
        $stmt = $this->db->prepare("SELECT agents.* FROM agents JOIN Mission_Agent ON agents.CodeID = Mission_Agent.AgentCodeID WHERE Mission_Agent.MissionNomCode = ?");
        $stmt->bind_param("s", $nomCode);
        $stmt->execute();
        $mission['agents'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
        $stmt = $this->db->prepare("SELECT contacts.* FROM contacts JOIN Mission_Contact ON contacts.NomCode = Mission_Contact.ContactNomCode WHERE Mission_Contact.MissionNomCode = ?");
        $stmt->bind_param("s", $nomCode);
        $stmt->execute();
        $mission['contacts'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
        $stmt = $this->db->prepare("SELECT cibles.* FROM cibles JOIN Mission_Cible ON cibles.NomCode = Mission_Cible.CibleNomCode WHERE Mission_Cible.MissionNomCode = ?");
        $stmt->bind_param("s", $nomCode);
        $stmt->execute();
        $mission['cibles'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
        $stmt = $this->db->prepare("SELECT planques.* FROM planques JOIN Mission_Planque ON planques.Code = Mission_Planque.PlanqueCode WHERE Mission_Planque.MissionNomCode = ?");
        $stmt->bind_param("s", $nomCode);
        $stmt->execute();
        $mission['planques'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
        return $mission;
    }
    
    

    public function addMission($titre, $description, $pays, $type, $statut, $specialite, $agents, $contacts, $cibles, $planques, $dateDebut) {
        $errors = [];
        $this->db->begin_transaction();
    
        try {
            $missionId = $this->generateUuid();
            $stmt = $this->db->prepare("INSERT INTO missions (NomCode, Titre, Description, Pays, TypeMission, Statut, SpecialiteRequise, DateDebut) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss",$missionId, $titre, $description, $pays, $type, $statut, $specialite, $dateDebut);
    
            if (!$stmt->execute()) {
                throw new Exception("Impossible d'ajouter la mission.");
            }
    
            $this->insertMissionRelations($missionId, 'Mission_Agent', $agents);
            $this->insertMissionRelations($missionId, 'Mission_Contact', $contacts);
            $this->insertMissionRelations($missionId, 'Mission_Cible', $cibles);
            $this->insertMissionRelations($missionId, 'Mission_Planque', $planques);
    
            $this->db->commit();
            return ['success' => true];
        } catch (Exception $e) {
            $this->db->rollback();
            error_log("Erreur lors de l'ajout de la mission: " . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    private function insertMissionRelations($missionNomCode, $tableName, $elements) {
        foreach ($elements as $elementId) {
            $elementColumn = "";
            switch ($tableName) {
                case 'Mission_Agent':
                    $elementColumn = "AgentCodeID";
                    break;
                case 'Mission_Contact':
                    $elementColumn = "ContactNomCode";
                    break;
                case 'Mission_Cible':
                    $elementColumn = "CibleNomCode";
                    break;
                case 'Mission_Planque':
                    $elementColumn = "PlanqueCode";
                    break;
            }
    
            $stmt = $this->db->prepare("INSERT INTO {$tableName} (MissionNomCode, {$elementColumn}) VALUES (?, ?)");
            $stmt->bind_param("ss", $missionNomCode, $elementId);
            if (!$stmt->execute()) {
                throw new Exception("Impossible d'ajouter les éléments à {$tableName}.");
            }
        }
    }    

    public function updateStatus($missionId, $newStatus) {
        $stmt = $this->db->prepare("UPDATE missions SET Statut = ?, DateFin = CASE WHEN ? IN ('Terminé', 'Echec') THEN NOW() ELSE DateFin END WHERE NomCode = ?");
        $stmt->bind_param("sss", $newStatus, $newStatus, $missionId);
        return $stmt->execute();
    }

    public function deleteMission($missionId) {
        $this->db->begin_transaction();
        try {
            $tables = ['Mission_Agent', 'Mission_Contact', 'Mission_Cible', 'Mission_Planque'];
            foreach ($tables as $table) {
                $stmt = $this->db->prepare("DELETE FROM {$table} WHERE MissionNomCode = ?");
                $stmt->bind_param("s", $missionId);
                $stmt->execute();
            }
    
            $stmt = $this->db->prepare("DELETE FROM missions WHERE NomCode = ?");
            $stmt->bind_param("s", $missionId);
            $stmt->execute();
    
            // Si tout va bien, transaction validée
            $this->db->commit();
            return true;
        } catch (\mysqli_sql_exception $e) {
            // En cas d'erreur, transaction annulée
            $this->db->rollback();
            throw $e;
        }
    }    
}
