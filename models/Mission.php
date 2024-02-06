<?php
require_once 'Model.php';

class Mission extends Model {
    public function getAll() {
        $sql = "SELECT * FROM missions";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addMission($titre, $description, $pays, $type, $statut, $specialite, $agents, $contacts, $cibles, $planques, $dateDebut) {
        $this->db->begin_transaction();
        try {
            $stmt = $this->db->prepare("INSERT INTO missions (Titre, Description, Pays, TypeMission, Statut, SpecialiteRequise, DateDebut) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $titre, $description, $pays, $type, $statut, $specialite, $dateDebut);
            $stmt->execute();
            $missionId = $this->db->insert_id;
    
            foreach ($agents as $agentId) {
                $stmt = $this->db->prepare("INSERT INTO Mission_Agent (MissionNomCode, AgentCodeID) VALUES (?, ?)");
                $stmt->bind_param("ii", $missionId, $agentId);
                $stmt->execute();
            }

            foreach ($contacts as $contactId) {
                $stmt = $this->db->prepare("INSERT INTO Mission_Contact (MissionNomCode, ContactNomCode) VALUES (?, ?)");
                $stmt->bind_param("ii", $missionId, $contactId);
                $stmt->execute();
            }

            foreach ($cibles as $cibleId) {
                $stmt = $this->db->prepare("INSERT INTO Mission_Cible (MissionNomCode, CibleNomCode) VALUES (?, ?)");
                $stmt->bind_param("ii", $missionId, $cibleId);
                $stmt->execute();
            }

            foreach ($planques as $planqueId) {
                $stmt = $this->db->prepare("INSERT INTO Mission_Planque (MissionNomCode, PlanqueCode) VALUES (?, ?)");
                $stmt->bind_param("ii", $missionId, $planqueId);
                $stmt->execute();
            }
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

}
