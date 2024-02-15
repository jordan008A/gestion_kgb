<?php
namespace App\Models;

use Exception;

class Specialite extends Model {
    public function getAll() {
        $sql = "SELECT Nom FROM specialites";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add($nom) {
        $this->db->begin_transaction();
        
        try {
    
            $stmt = $this->db->prepare("INSERT INTO specialites (Nom) VALUES (?)");
            $stmt->bind_param("s", $nom);
            if (!$stmt->execute()) {
                throw new Exception("Erreur lors de l'insertion de la spécialité.");
            }
        
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollback();
            error_log($e->getMessage());
            return false;
        }
    }

    public function getByName($nom) {
        $stmt = $this->db->prepare("SELECT Nom FROM specialites WHERE Code = ?");
        $stmt->bind_param("s", $nom);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function delete($nom) {
        $this->db->begin_transaction();
        try {
    
            $stmt = $this->db->prepare("DELETE FROM specialites WHERE Nom = ?");
            $stmt->bind_param("s", $nom);
            if (!$stmt->execute()) {
                throw new Exception("Impossible de supprimer la spécialité.");
            }
    
            $this->db->commit();
            return ['success' => true];
        } catch (\mysqli_sql_exception $e) {
            $this->db->rollback();
            return ['success' => false, 'message' => "Cette spécialité est toujours demandée et ne peut pas être supprimée."];
        } catch (Exception $e) {
            $this->db->rollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}
