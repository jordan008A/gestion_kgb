<?php
require_once 'Model.php';

class Administrateur extends Model {
    public function getByEmail($email) {
        $sql = "SELECT * FROM administrateurs WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

}
