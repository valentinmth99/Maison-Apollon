<?php
require_once('./config/cors.php');
require_once("./config/database.php");

require_once('./controller/AuthController.php');

// Récupérer l'URL et la méthode de la requête
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$endpoint = basename($requestUri);

switch ($endpoint) {
    case 'register':
        if ($requestMethod == 'POST') {
            // // Initialiser le contrôleur utilisateur uniquement pour cette fonctionnalité
            // require_once('./controller/AuthController.php');
            $authController = new AuthController($conn);

            $email = $_POST['email'];
            $password = $_POST['password'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];

            // Appeler la fonction d'enregistrement du contrôleur
            $result = $authController->register($email, $password, $firstname, $lastname, $username);
            echo json_encode($result);
        } else {
            echo json_encode(["success" => false, "message" => "Invalid request method."]);
        }
        break;

    // case 'login':
    //     if ($requestMethod == 'POST') {
    //         // Initialiser le contrôleur utilisateur uniquement pour cette fonctionnalité
    //         require 'UserController.php';
    //         $userController = new UserController($conn);

    //         $email = $_POST['email'];
    //         $password = $_POST['password'];

    //         // Appeler la fonction de connexion du contrôleur
    //         $result = $userController->login($email, $password);
    //         echo json_encode($result);
    //     } else {
    //         echo json_encode(["success" => false, "message" => "Invalid request method."]);
    //     }
    //     break;

    // Vous pouvez ajouter d'autres cas ici pour gérer d'autres fonctionnalités

    default:
        echo json_encode(["success" => false, "message" => "Endpoint not found."]);
        break;
}

$conn->close();

?>
