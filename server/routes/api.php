<?php

require_once '../controllers/AuthController.php';
require_once '../config/cors.php';

$authController = new AuthController();

$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'POST':
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($path === '/register') {
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode($authController->register($data));
        } elseif ($path === '/login') {
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode($authController->login($data));
        } elseif ($path === '/logout') {
            echo json_encode($authController->logout());
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
?>
