<?php
require_once 'Model.php';

class Specialite extends Model {
    public function getAll() {
        $sql = "SELECT * FROM specialites";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
