<?php
require_once 'Model.php';

class Agent extends Model {
    public function getAll() {
        $sql = "SELECT * FROM agents";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
