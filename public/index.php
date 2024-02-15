<?php

use App\Controllers\MissionsController;
use App\Controllers\AdminAgentsController;
use App\Controllers\AdminCiblesController;
use App\Controllers\AdminContactsController;
use App\Controllers\AdminMissionsController;
use App\Controllers\AdminPlanquesController;

session_start();


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
        require_once BASE_PATH . '/app/controllers/MissionsController.php';
        $controller = new MissionsController();
        $controller->index();
    },
    '/missions/details' => function() {
        require_once BASE_PATH . '/app/controllers/MissionsController.php';
        if (isset($_GET['nomCode'])) {
            $controller = new MissionsController();
            $controller->details($_GET['nomCode']);
        } else {
            http_response_code(404);
            require BASE_PATH . '/app/views/404.php';
        }
    },
    '/missions/add' => function() { 
        require_once BASE_PATH . '/app/controllers/MissionsController.php';
        $controller = new MissionsController();
        $controller->add();
    },
    '/missions/store' => function() {
        require_once BASE_PATH . '/app/controllers/MissionsController.php';
        $controller = new MissionsController();
        $controller->store();
    },
    '/admin/missions' => function() {
        require_once BASE_PATH . '/app/controllers/AdminMissionsController.php';
        $controller = new AdminMissionsController();
        $controller->index();
    },
    '/admin/missions/changeStatus' => function() {
        require_once BASE_PATH . '/app/controllers/AdminMissionsController.php';
        $controller = new AdminMissionsController();
        $controller->changeStatus();
    },
    '/admin/missions/delete' => function() {
        require_once BASE_PATH . '/app/controllers/AdminMissionsController.php';
        $controller = new AdminMissionsController();
        $controller->delete();
    },
    '/admin/agents' => function() {
        $controller = new AdminAgentsController();
        $controller->index();
    },
    '/admin/agents/create' => function() {
        $controller = new AdminAgentsController();
        $controller->create();
    },
    '/admin/agents/edit' => function() {
        $controller = new AdminAgentsController();
        $controller->edit();
    },
    '/admin/agents/delete' => function() {
        $controller = new AdminAgentsController();
        $controller->delete();
    },
    '/admin/agents/details' => function() {
        if (isset($_GET['agentId'])) {
            $controller = new AdminAgentsController();
            $controller->details($_GET['agentId']);
        } else {
            http_response_code(404);
            require BASE_PATH . '/app/views/404.php';
        }
    },
    '/admin/cibles' => function() {
        $controller = new AdminCiblesController();
        $controller->index();
    },
    '/admin/cibles/create' => function() {
        $controller = new AdminCiblesController();
        $controller->create();
    },
    '/admin/cibles/edit' => function() {
        $controller = new AdminCiblesController();
        $controller->edit();
    },
    '/admin/cibles/delete' => function() {
        $controller = new AdminCiblesController();
        $controller->delete();
    },
    '/admin/cibles/details' => function() {
        if (isset($_GET['cibleId'])) {
            $controller = new AdminCiblesController();
            $controller->details($_GET['cibleId']);
        } else {
            http_response_code(404);
            require BASE_PATH . '/app/views/404.php';
        }
    },
    '/admin/contacts' => function() {
        $controller = new AdminContactsController();
        $controller->index();
    },
    '/admin/contacts/create' => function() {
        $controller = new AdminContactsController();
        $controller->create();
    },
    '/admin/contacts/edit' => function() {
        $controller = new AdminContactsController();
        $controller->edit();
    },
    '/admin/contacts/delete' => function() {
        $controller = new AdminContactsController();
        $controller->delete();
    },
    '/admin/contacts/details' => function() {
        if (isset($_GET['contactId'])) {
            $controller = new AdminContactsController();
            $controller->details($_GET['contactId']);
        } else {
            http_response_code(404);
            require BASE_PATH . '/app/views/404.php';
        }
    },
    '/admin/planques' => function() {
        $controller = new AdminPlanquesController();
        $controller->index();
    },
    '/admin/planques/create' => function() {
        $controller = new AdminPlanquesController();
        $controller->create();
    },
    '/admin/planques/edit' => function() {
        $controller = new AdminPlanquesController();
        $controller->edit();
    },
    '/admin/planques/delete' => function() {
        $controller = new AdminPlanquesController();
        $controller->delete();
    },
    '/admin/planques/details' => function() {
        if (isset($_GET['planqueId'])) {
            $controller = new AdminPlanquesController();
            $controller->details($_GET['planqueId']);
        } else {
            http_response_code(404);
            require BASE_PATH . '/app/views/404.php';
        }
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
