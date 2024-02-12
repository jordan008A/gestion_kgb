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
}
