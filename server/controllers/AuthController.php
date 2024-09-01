<?php

require_once '../config/database.php';
require_once '../models/User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register($data) {
        $this->user->email = $data['email'];
        $this->user->password = $data['password'];
        $this->user->firstname = $data['firstname'];
        $this->user->lastname = $data['lastname'];
        $this->user->username = $data['username'];

        if ($this->user->register()) {
            return ['status' => 'success', 'message' => 'User registered successfully.'];
        } else {
            return ['status' => 'error', 'message' => 'User registration failed.'];
        }
    }

    public function login($data) {
        $this->user->email = $data['email'];
        $this->user->password = $data['password'];

        $user = $this->user->login();

        if ($user) {
            return ['status' => 'success', 'user' => $user];
        } else {
            return ['status' => 'error', 'message' => 'Invalid email or password.'];
        }
    }

    public function logout() {
        // Pour un système basé sur des sessions
        session_start();
        session_destroy();
        return ['status' => 'success', 'message' => 'Logged out successfully.'];
    }
}
?>
