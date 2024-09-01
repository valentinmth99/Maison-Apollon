<?php
class UserModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Vérifier si un email ou un username existe déjà
    public function userExists($email, $username) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return true;
        }

        return false;
    }

    // Enregistrer un nouvel utilisateur
    public function register($email, $password, $firstname, $lastname, $username) {
        $stmt = $this->conn->prepare("INSERT INTO users (email, password, firstname, lastname, username) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $email, $password, $firstname, $lastname, $username);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
