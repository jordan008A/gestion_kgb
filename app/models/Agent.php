<?php

namespace App\Models;

use Exception;

class Agent extends Model {
    public function getAll() {
        $sql = "SELECT agents.*, GROUP_CONCAT(specialites.Nom SEPARATOR ', ') AS Specialites 
                FROM agents 
                LEFT JOIN Agent_Specialite ON agents.CodeID = Agent_Specialite.AgentCodeID 
                LEFT JOIN specialites ON Agent_Specialite.SpecialiteNom = specialites.Nom 
                GROUP BY agents.CodeID";
        $result = $this->db->query($sql);
        if (!$result) {
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add($nom, $prenom, $dateNaissance, $nationalite, $specialites) {
        $this->db->begin_transaction();
        
        try {
            $agentId = $this->generateUuid();
    
            $stmt = $this->db->prepare("INSERT INTO agents (CodeID, Nom, Prenom, DateNaissance, Nationalite) VALUES (?, ?, ?, ?, ?)"); // Corrigé pour inclure 5 placeholders
            $stmt->bind_param("sssss", $agentId, $nom, $prenom, $dateNaissance, $nationalite);
            if (!$stmt->execute()) {
                throw new Exception("Erreur lors de l'insertion de l'agent.");
            }
            
            foreach ($specialites as $specialite) {
                $stmt = $this->db->prepare("INSERT INTO Agent_Specialite (AgentCodeID, SpecialiteNom) VALUES (?, ?)");
                $stmt->bind_param("ss", $agentId, $specialite);
                if (!$stmt->execute()) {
                    throw new Exception("Erreur lors de l'ajout d'une spécialité à l'agent.");
                }
            }
        
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollback();
            error_log($e->getMessage());
            return false;
        }
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM agents WHERE CodeID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id, $nom, $prenom, $dateNaissance, $nationalite) {
        $stmt = $this->db->prepare("UPDATE agents SET Nom = ?, Prenom = ?, DateNaissance = ?, Nationalite = ? WHERE CodeID = ?");
        $stmt->bind_param("sssss", $nom, $prenom, $dateNaissance, $nationalite, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $this->db->begin_transaction();
        try {
            $stmt = $this->db->prepare("DELETE FROM Agent_Specialite WHERE AgentCodeID = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
    
            $stmt = $this->db->prepare("DELETE FROM agents WHERE CodeID = ?");
            $stmt->bind_param("s", $id);
            if (!$stmt->execute()) {
                throw new Exception("Impossible de supprimer l'agent.");
            }
    
            $this->db->commit();
            return ['success' => true];
        } catch (\mysqli_sql_exception $e) {
            $this->db->rollback();
            return ['success' => false, 'message' => "Cet agent est en service et ne peut pas être supprimé."];
        } catch (Exception $e) {
            $this->db->rollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    

    public function getSpecialitesByAgentId($agentId) {
        $sql = "SELECT specialites.Nom 
                FROM Agent_Specialite 
                JOIN specialites ON Agent_Specialite.SpecialiteNom = specialites.Nom 
                WHERE Agent_Specialite.AgentCodeID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $agentId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $specialites = [];
        while ($row = $result->fetch_assoc()) {
            $specialites[] = $row['Nom'];
        }
        
        return $specialites;
    }

    public function deleteSpecialites($agentId) {
        $stmt = $this->db->prepare("DELETE FROM Agent_Specialite WHERE AgentCodeID = ?");
        $stmt->bind_param("s", $agentId);
        $stmt->execute();
    }

    public function addSpecialite($agentId, $specialiteNom) {
        $stmt = $this->db->prepare("INSERT INTO Agent_Specialite (AgentCodeID, SpecialiteNom) VALUES (?, ?)");
        $stmt->bind_param("ss", $agentId, $specialiteNom);
        $stmt->execute();
    }
}
