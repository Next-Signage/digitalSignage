<?php

session_start();

// carregar controllers

// pra frente talvez vamos usar composer, daí movemos isso
require_once __DIR__ . '/../src/core/Database.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';
require_once __DIR__ . '/../src/controllers/UserController.php';

// aqui é a config do router
$request_uri = $_SERVER['REQUEST_URI'];

$base_path = dirname($_SERVER['SCRIPT_NAME']);


$route = str_replace($base_path, '', $request_uri);
$route = trim($route, '/');
$route = strtok($route, '?'); // Remove query strings (ex: ?error=1)

if ($route === '') {
    $route = 'login';
}

// cria instâncias dos controllers
$authController = new AuthController();
$userController = new UserController();

// agora as rotas
switch ($route) {
    case 'login':
        $authController->showLoginForm();
        break;
    case 'login/authenticate':
        $authController->authenticate();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'signup':
        $userController->showSignupForm();
        break;
    case 'signup/register':
        $userController->register();
        break;
    
    case 'dashboard':
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            header('Location: ' . $base_path . '/login');
            exit;
        }

        $userController->dashboard();
        break;

    case 'verificar-email':
        $userController->verifyEmailAjax();
        break;
    case 'verificar-cpf':
        $userController->verifyCpfAjax();
        break;
        
    default:
        http_response_code(404);
        echo "<h1>Erro 404 - Página Não Encontrada</h1>";
        break;
}