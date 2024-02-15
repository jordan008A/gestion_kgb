<?php
namespace App\Models;

use Exception;

class Planque extends Model {
    public function getAll() {
        $sql = "SELECT * FROM planques";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add($adresse, $pays, $type) {
        $this->db->begin_transaction();
        
        try {
            $planqueId = $this->generateUuid();
    
            $stmt = $this->db->prepare("INSERT INTO planques (Code, Adresse, Pays, Type) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $planqueId, $adresse, $pays, $type);
            if (!$stmt->execute()) {
                throw new Exception("Erreur lors de l'insertion de la planque.");
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
        $stmt = $this->db->prepare("SELECT * FROM planques WHERE Code = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id, $adresse, $pays, $type) {
        $stmt = $this->db->prepare("UPDATE planques SET Adresse = ?, Pays = ?, Type = ? WHERE Code = ?");
        $stmt->bind_param("ssss", $adresse, $pays, $type, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $this->db->begin_transaction();
        try {
    
            $stmt = $this->db->prepare("DELETE FROM planques WHERE Code = ?");
            $stmt->bind_param("s", $id);
            if (!$stmt->execute()) {
                throw new Exception("Impossible de supprimer la planque.");
            }
    
            $this->db->commit();
            return ['success' => true];
        } catch (\mysqli_sql_exception $e) {
            $this->db->rollback();
            return ['success' => false, 'message' => "Cette planque est toujours opérationnelle et ne peut pas être supprimée."];
        } catch (Exception $e) {
            $this->db->rollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}
