<?php
namespace App\Models;

class Administrateur extends Model {
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
}
