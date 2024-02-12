<?php
namespace App\Models;

class Cible extends Model {
    public function getAll() {
        $sql = "SELECT * FROM cibles";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
