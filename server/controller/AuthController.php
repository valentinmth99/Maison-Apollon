<?php
require_once('../model/UserModel.php');

class AuthController {
    private $userModel;

    public function __construct($dbConnection) {
        $this->userModel = new UserModel($dbConnection);
    }

    // Fonction pour gérer l'inscription d'un utilisateur
    public function register($email, $password, $firstname, $lastname, $username) {
        // Vérifier si l'utilisateur existe déjà
        if ($this->userModel->userExists($email, $username)) {
            return ["success" => false, "message" => "Email or Username already exists."];
        }

        // Vérifier la force du mot de passe
        if (!$this->isPasswordStrong($password)) {
            return ["success" => false, "message" => "Password must be : at least 8+ characters long and include at least one uppercase letter, one lowercase letter, one digit, and one special character."];
        }

        // Hash du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Enregistrer l'utilisateur
        if ($this->userModel->register($email, $hashedPassword, $firstname, $lastname, $username)) {
            return ["success" => true, "message" => "User registered successfully."];
        }

        return ["success" => false, "message" => "Registration failed. Please try again."];
    }

    // Fonction pour vérifier la force du mot de passe
    private function isPasswordStrong($password) {
        $hasUpperCase = preg_match('@[A-Z]@', $password);
        $hasLowerCase = preg_match('@[a-z]@', $password);
        $hasDigit = preg_match('@[0-9]@', $password);
        $hasSpecialChar = preg_match('@[^\w]@', $password);
        $hasMinLength = strlen($password) >= 8;

        return $hasUpperCase && $hasLowerCase && $hasDigit && $hasSpecialChar && $hasMinLength;
    }
}
?>
