<?php

namespace App\Models;

use mysqli;
use Dotenv\Dotenv;

class Model {
    protected $db;

    public function __construct() {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        
        $this->db = new mysqli(
            $_ENV['JAWSDB_HOST'] ?? $_ENV['DB_HOST'], 
            $_ENV['JAWSDB_USERNAME'] ?? $_ENV['DB_USERNAME'], 
            $_ENV['JAWSDB_PASSWORD'] ?? $_ENV['DB_PASSWORD'], 
            $_ENV['JAWSDB_NAME'] ?? $_ENV['DB_NAME']
        );
        
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function generateUuid() {
        return uniqid('', true);
    }
}
