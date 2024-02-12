<?php
namespace App\Models;

class Planque extends Model {
    public function getAll() {
        $sql = "SELECT * FROM planques";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
