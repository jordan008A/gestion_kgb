<?php
require_once 'Model.php';

class Mission extends Model {
    public function getAll() {
        $sql = "SELECT * FROM missions";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
