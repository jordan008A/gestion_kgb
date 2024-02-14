<?php
namespace App\Models;

use Exception;

class Cible extends Model {
    public function getAll() {
        $sql = "SELECT * FROM cibles";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add($nom, $prenom, $dateNaissance, $nationalite) {
        $this->db->begin_transaction();
        
        try {
            $cibleId = $this->generateUuid();
    
            $stmt = $this->db->prepare("INSERT INTO cibles (NomCode, Nom, Prenom, DateNaissance, Nationalite) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $cibleId, $nom, $prenom, $dateNaissance, $nationalite);
            if (!$stmt->execute()) {
                throw new Exception("Erreur lors de l'insertion de la cible.");
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
        $stmt = $this->db->prepare("SELECT * FROM cibles WHERE NomCode = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id, $nom, $prenom, $dateNaissance, $nationalite) {
        $stmt = $this->db->prepare("UPDATE cibles SET Nom = ?, Prenom = ?, DateNaissance = ?, Nationalite = ? WHERE NomCode = ?");
        $stmt->bind_param("sssss", $nom, $prenom, $dateNaissance, $nationalite, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $this->db->begin_transaction();
        try {
    
            $stmt = $this->db->prepare("DELETE FROM cibles WHERE NomCode = ?");
            $stmt->bind_param("s", $id);
            if (!$stmt->execute()) {
                throw new Exception("Impossible de supprimer la cible.");
            }
    
            $this->db->commit();
            return ['success' => true];
        } catch (\mysqli_sql_exception $e) {
            $this->db->rollback();
            return ['success' => false, 'message' => "Cette cible est toujours en cavale et ne peut pas être supprimée."];
        } catch (Exception $e) {
            $this->db->rollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
