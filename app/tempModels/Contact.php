<?php
namespace App\Models;

use Exception;

class Contact extends Model {
    public function getAll() {
        $sql = "SELECT * FROM contacts";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add($nom, $prenom, $dateNaissance, $nationalite, $pays) {
        $this->db->begin_transaction();
        
        try {
            $contactId = $this->generateUuid();
    
            $stmt = $this->db->prepare("INSERT INTO contacts (NomCode, Nom, Prenom, DateNaissance, Nationalite, Pays) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $contactId, $nom, $prenom, $dateNaissance, $nationalite, $pays);
            if (!$stmt->execute()) {
                throw new Exception("Erreur lors de l'insertion du contact.");
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
        $stmt = $this->db->prepare("SELECT * FROM contacts WHERE NomCode = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id, $nom, $prenom, $dateNaissance, $nationalite, $pays) {
        $stmt = $this->db->prepare("UPDATE contacts SET Nom = ?, Prenom = ?, DateNaissance = ?, Nationalite = ?, Pays = ? WHERE NomCode = ?");
        $stmt->bind_param("ssssss", $nom, $prenom, $dateNaissance, $nationalite, $pays, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $this->db->begin_transaction();
        try {
    
            $stmt = $this->db->prepare("DELETE FROM contacts WHERE NomCode = ?");
            $stmt->bind_param("s", $id);
            if (!$stmt->execute()) {
                throw new Exception("Impossible de supprimer le contact.");
            }
    
            $this->db->commit();
            return ['success' => true];
        } catch (\mysqli_sql_exception $e) {
            $this->db->rollback();
            return ['success' => false, 'message' => "Ce contact est toujours en service et ne peut pas être supprimé."];
        } catch (Exception $e) {
            $this->db->rollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}
