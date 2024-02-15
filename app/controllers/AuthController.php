<?php

namespace App\Controllers;

use App\Models\Administrateur;

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            $adminModel = new Administrateur();
            $admin = $adminModel->getByEmail($email);
    
            if ($admin && password_verify($password, $admin['MotDePasse'])) {
                $_SESSION['admin_id'] = $admin['AdresseMail'];
                header('Location: ' . BASE_URL . '/');
                exit();
            } else {
                $_SESSION['error_message'] = 'Identifiants incorrects.';
                header('Location: ' . BASE_URL . '/login');
                exit();
            }            
        }
        require_once BASE_PATH . '/app/views/login.php';
    }
    

    public function logout() {
        unset($_SESSION['admin_id']);
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
        exit();
    }

    public static function isAuthenticated() {
        return isset($_SESSION['admin_id']);
    }

    public static function checkAuthAndExecute($controllerCallback) {
        if (!self::isAuthenticated()) {
            header('Location: ' . BASE_URL . '/login');
            exit();
        } else {
            call_user_func($controllerCallback);
        }
    }
}
