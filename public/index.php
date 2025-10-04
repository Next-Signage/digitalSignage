<?php

session_start();

// Carrega os arquivos necessários (futuramente substituído por autoloading)
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/core/Database.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';
require_once __DIR__ . '/../src/controllers/UserController.php';

$db = new Database();
$pdo = $db->getConnection();

// extração da rota
$route = $_GET['route'] ?? ''; // pega a rota da query string de .htacess (ou deixa vazio)
$route = trim($route, '/');

if ($route === '') {
    $route = 'login';
}

// pega o método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// e mapeia elas
$routes = [
    'GET' => [
        'login' => ['AuthController', 'showLoginForm'],
        'logout' => ['AuthController', 'logout'],
        'signup' => ['UserController', 'showSignupForm'],
        'dashboard' => ['UserController', 'dashboard'],
        'verificar-email' => ['UserController', 'verifyEmailAjax'],
        'verificar-cpf' => ['UserController', 'verifyCpfAjax'],
    ],
    'POST' => [
        'login/authenticate' => ['AuthController', 'authenticate'],
        'signup/register' => ['UserController', 'register'],
    ]
];

// despacho
if (isset($routes[$method][$route])) {
    list($controllerName, $action) = $routes[$method][$route];

    // proteção
    if ($route === 'dashboard') {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    $controller = new $controllerName($pdo); // entrega o $pdo para o controller
    $controller->$action();

} else {
    http_response_code(404);
    echo "<h1>Erro 404 - Página Não Encontrada</h1>";
}