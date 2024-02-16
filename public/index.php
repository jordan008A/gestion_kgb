<?php

use App\Controllers\AuthController;
use App\Controllers\MissionsController;
use App\Controllers\AdminAgentsController;
use App\Controllers\AdminCiblesController;
use App\Controllers\AdminContactsController;
use App\Controllers\AdminMissionsController;
use App\Controllers\AdminPlanquesController;
use App\Controllers\AdminSpecialitesController;

session_start();


ini_set('display_errors', 0);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

define('BASE_PATH', realpath(__DIR__ . '/..'));

if ($_SERVER['HTTP_HOST'] == "localhost") {
    define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/gestion_kgb/public');
} else {
    define('BASE_URL', '');
}

$routes = [
    '/' => function() { require BASE_PATH . '/app/views/home.php'; },
    '/missions' => function() {
        $controller = new MissionsController();
        $controller->index();
    },
    '/missions/details' => function() {
        if (isset($_GET['nomCode'])) {
            $controller = new MissionsController();
            $controller->details($_GET['nomCode']);
        } else {
            http_response_code(404);
            require BASE_PATH . '/app/views/404.php';
        }
    },
    '/missions/add' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new MissionsController();
            $controller->add();
        });
    },
    '/missions/store' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new MissionsController();
            $controller->store();
        });
    },
    '/admin/missions' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminMissionsController();
            $controller->index();
        });
    },
    '/admin/missions/changeStatus' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminMissionsController();
            $controller->changeStatus();
        });
    },
    '/admin/missions/delete' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminMissionsController();
            $controller->delete();
        });
    },
    '/admin/agents' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminAgentsController();
            $controller->index();
        });
    },
    '/admin/agents/create' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminAgentsController();
            $controller->create();
        });
    },
    '/admin/agents/edit' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminAgentsController();
            $controller->edit();
        });
    },
    '/admin/agents/delete' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminAgentsController();
            $controller->delete();
        });
    },
    '/admin/agents/details' => function() {
        AuthController::checkAuthAndExecute(function() {
            if (isset($_GET['agentId'])) {
                $controller = new AdminAgentsController();
                $controller->details($_GET['agentId']);
            } else {
                http_response_code(404);
                require BASE_PATH . '/app/views/404.php';
            }
        });
    },
    '/admin/cibles' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminCiblesController();
            $controller->index();
        });
    },
    '/admin/cibles/create' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminCiblesController();
            $controller->create();
        });
    },
    '/admin/cibles/edit' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminCiblesController();
            $controller->edit();
        });
    },
    '/admin/cibles/delete' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminCiblesController();
            $controller->delete();
        });
    },
    '/admin/cibles/details' => function() {
        AuthController::checkAuthAndExecute(function() {
            if (isset($_GET['cibleId'])) {
                $controller = new AdminCiblesController();
                $controller->details($_GET['cibleId']);
            } else {
                http_response_code(404);
                require BASE_PATH . '/app/views/404.php';
            }
        });
    },
    '/admin/contacts' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminContactsController();
            $controller->index();
        });
    },
    '/admin/contacts/create' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminContactsController();
            $controller->create();
        });
    },
    '/admin/contacts/edit' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminContactsController();
            $controller->edit();
        });
    },
    '/admin/contacts/delete' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminContactsController();
            $controller->delete();
        });
    },
    '/admin/contacts/details' => function() {
        AuthController::checkAuthAndExecute(function() {
            if (isset($_GET['contactId'])) {
                $controller = new AdminContactsController();
                $controller->details($_GET['contactId']);
            } else {
                http_response_code(404);
                require BASE_PATH . '/app/views/404.php';
            }
        });
    },
    '/admin/planques' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminPlanquesController();
            $controller->index();
        });
    },
    '/admin/planques/create' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminPlanquesController();
            $controller->create();
        });
    },
    '/admin/planques/edit' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminPlanquesController();
            $controller->edit();
        });
    },
    '/admin/planques/delete' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminPlanquesController();
            $controller->delete();
        });
    },
    '/admin/planques/details' => function() {
        AuthController::checkAuthAndExecute(function() {
            if (isset($_GET['planqueId'])) {
                $controller = new AdminPlanquesController();
                $controller->details($_GET['planqueId']);
            } else {
                http_response_code(404);
                require BASE_PATH . '/app/views/404.php';
            }
        });
    },
    '/admin/specialites' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminSpecialitesController();
            $controller->index();
        });
    },
    '/admin/specialites/create' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminSpecialitesController();
            $controller->create();
        });
    },
    '/admin/specialites/delete' => function() {
        AuthController::checkAuthAndExecute(function() {
            $controller = new AdminSpecialitesController();
            $controller->delete();
        });
    },
    '/login' => function() {
        $controller = new AuthController();
        $controller->login();
    },
    '/logout' => function() {
        $controller = new AuthController();
        $controller->logout();
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
