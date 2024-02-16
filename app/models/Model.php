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
            getenv('JAWSDB_HOST') ?: getenv('DB_HOST'), 
            getenv('JAWSDB_USERNAME') ?: getenv('DB_USERNAME'), 
            getenv('JAWSDB_PASSWORD') ?: getenv('DB_PASSWORD'), 
            getenv('JAWSDB_NAME') ?: getenv('DB_NAME')
        );
        
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function generateUuid() {
        return uniqid('', true);
    }
}
