<?php
namespace App\Models;

use Exception;

class Administrateur extends Model {

    public function getAll() {
        $sql = "SELECT * FROM administrateurs";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getByEmail($email) {
        $sql = "SELECT * FROM administrateurs WHERE AdresseMail = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function createAdmin($nom, $prenom, $email, $hashedPassword) {
        $sql = "INSERT INTO administrateurs (Nom, Prenom, AdresseMail, MotDePasse, DateCreation) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            echo "Erreur lors de la préparation de la requête: " . $this->db->error;
            return false;
        }
        $stmt->bind_param("ssss", $nom, $prenom, $email, $hashedPassword);
        if (!$stmt->execute()) {
            echo "Erreur lors de l'exécution de la requête: " . $stmt->error;
            return false;
        }
        return true;
    }

    public function delete($email) {
        $this->db->begin_transaction();
        try {
    
            $stmt = $this->db->prepare("DELETE FROM administrateurs WHERE AdresseMail = ?");
            $stmt->bind_param("s", $email);
            if (!$stmt->execute()) {
                throw new Exception("Impossible de supprimer l'administrateur.");
            }
    
            $this->db->commit();
            return ['success' => true];
        } catch (Exception $e) {
            $this->db->rollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
