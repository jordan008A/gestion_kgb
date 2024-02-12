<?php
namespace App\Models;

class Contact extends Model {
    public function getAll() {
        $sql = "SELECT * FROM contacts";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
