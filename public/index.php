<?php
session_start();
use App\Controllers\MissionsController;

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

// Définition du chemin de base du système de fichiers
define('BASE_PATH', realpath(__DIR__ . '/..'));

// Définition de la base de l'URL pour une utilisation dans les liens et les ressources
if ($_SERVER['HTTP_HOST'] == "localhost") {
    define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/gestion_kgb/public');
} else {
    // Adaptation pour l'environnement de production
    define('BASE_URL', '');
}

// Configuration des routes de l'application
$routes = [
    '/' => function() { require BASE_PATH . '/app/views/home.php'; },
    '/missions' => function() { 
        require_once BASE_PATH . '/app/controllers/missionsController.php';
        $controller = new MissionsController();
        $controller->index();
    },
    '/missions/details' => function() {
        require_once BASE_PATH . '/app/controllers/missionsController.php';
        if (isset($_GET['nomCode'])) {
            $controller = new MissionsController();
            $controller->details($_GET['nomCode']);
        } else {
            // Gérer l'erreur ou rediriger
            http_response_code(404);
            require BASE_PATH . '/app/views/404.php';
        }
    },
    '/missions/add' => function() { 
        require_once BASE_PATH . '/app/controllers/missionsController.php';
        $controller = new MissionsController();
        $controller->add();
    },
    '/missions/store' => function() {
        require_once BASE_PATH . '/app/controllers/missionsController.php';
        $controller = new MissionsController();
        $controller->store();
    },
    '/404' => function() { require BASE_PATH . '/app/views/404.php'; },
];

// Extraction du chemin demandé et normalisation
$requestedPath = str_replace('/gestion_kgb/public', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$requestedPath = rtrim($requestedPath, '/');
if (empty($requestedPath)) {
    $requestedPath = '/';
}

// Exécution de l'action de route correspondante ou affichage de la page 404
if (array_key_exists($requestedPath, $routes)) {
    $routeAction = $routes[$requestedPath];
    $routeAction();
} else {
    http_response_code(404);
    require BASE_PATH . '/app/views/404.php';
}
