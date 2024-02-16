<?php

namespace App\Controllers;

use App\Models\Administrateur;

class AuthController {
    public function login() {

        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['error_message'] = 'Erreur de validation. Veuillez réessayer.';
                header('Location: ' . BASE_URL . '/404');
                exit();
            }
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
        require_once BASE_PATH . '/app/Views/login.php';
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
