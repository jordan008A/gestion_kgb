<?php

namespace App\Models;

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
        $stmt = $this->db->prepare("INSERT INTO agents (Nom, Prenom, DateNaissance, Nationalite) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nom, $prenom, $dateNaissance, $nationalite);
        if (!$stmt->execute()) {
            return false;
        }
        $agentId = $stmt->insert_id;
        foreach ($specialites as $specialite) {
            $stmt = $this->db->prepare("INSERT INTO Agent_Specialite (AgentCodeID, SpecialiteNom) VALUES (?, ?)");
            $stmt->bind_param("ss", $agentId, $specialite);
            $stmt->execute();
        }
        return true;
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
        $stmt = $this->db->prepare("DELETE FROM Agent_Specialite WHERE AgentCodeID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();

        $stmt = $this->db->prepare("DELETE FROM agents WHERE CodeID = ?");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }
}
