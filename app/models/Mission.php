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
        $this->db->begin_transaction();
        try {
            $missionId = $this->generateUuid();
    
            $stmt = $this->db->prepare("INSERT INTO missions (NomCode, Titre, Description, Pays, TypeMission, Statut, SpecialiteRequise, DateDebut) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $missionId, $titre, $description, $pays, $type, $statut, $specialite, $dateDebut);
            $stmt->execute();
    
            foreach ($agents as $agentId) {
                $stmt = $this->db->prepare("INSERT INTO Mission_Agent (MissionNomCode, AgentCodeID) VALUES (?, ?)");
                $stmt->bind_param("ss", $missionId, $agentId);
                $stmt->execute();
            }

            foreach ($contacts as $contactId) {
                $stmt = $this->db->prepare("INSERT INTO Mission_Contact (MissionNomCode, ContactNomCode) VALUES (?, ?)");
                $stmt->bind_param("ss", $missionId, $contactId);
                $stmt->execute();
            }

            foreach ($cibles as $cibleId) {
                $stmt = $this->db->prepare("INSERT INTO Mission_Cible (MissionNomCode, CibleNomCode) VALUES (?, ?)");
                $stmt->bind_param("ss", $missionId, $cibleId);
                $stmt->execute();
            }

            foreach ($planques as $planqueId) {
                $stmt = $this->db->prepare("INSERT INTO Mission_Planque (MissionNomCode, PlanqueCode) VALUES (?, ?)");
                $stmt->bind_param("ss", $missionId, $planqueId);
                $stmt->execute();
            }
            
            $this->db->commit();
            return ['success' => true];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}
