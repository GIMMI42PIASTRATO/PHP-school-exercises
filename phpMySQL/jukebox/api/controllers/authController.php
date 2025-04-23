<?php

require_once __DIR__ . "/../models/UserModel.php";

class AuthController
{
    public static function login(Request $req, Response $res)
    {
        // Get the body content
        $email = $req->body['email'] ?? '';
        $password = $req->body['password'] ?? '';

        // Validate input
        if (empty($email) || empty($password)) {
            $res->status(400)->json([
                'success' => false,
                'message' => 'Email and password are required'
            ]);
            return;
        }

        // Attempt login
        try {
            $user = UserModel::findUserByEmail($email);
        } catch (PDOException) {
            $res->status(500)->json([
                'success' => false,
                'message' => "Database connection failed, try later"
            ]);
            return;
        }

        if (!$user) {
            $res->status(401)->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ]);
            return;
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            $res->status(401)->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ]);
            return;
        }

        // Check if the user is active
        if (!$user['attivo']) {
            $res->status(401)->json([
                'success' => false,
                'message' => 'Account is deactivated'
            ]);
            return;
        }

        // Start session and set user info
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['ruolo_id'];

        // Return success response
        $res->status(200)->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role_id' => $user['ruolo_id']
            ]
        ]);
    }

    public static function register(Request $req, Response $res)
    {
        // Get the body content
        $username = $req->body["username"] ?? '';
        $email = $req->body["email"] ?? '';
        $password = $req->body["password"] ?? '';

        // Debug output to server console
        error_log("[" . date("Y-m-d H:i:s") . "] Registration attempt - Username: $username, Email: $email, Password length: " . strlen($password));


        // Validate input
        if (empty($username) || empty($email) || empty($password)) {
            $res->status(400)->json([
                'success' => false,
                'message' => 'Username, email and password are required'
            ]);
            return;
        }

        try {
            // Check for existing username
            if (UserModel::userExists($username)) {
                $res->status(409)->json([
                    'success' => false,
                    'message' => "Username already taken"
                ]);
                return;
            }

            // Check for existing email
            if (UserModel::emailExists($email)) {
                $res->status(409)->json([
                    'success' => false,
                    'message' => "Email already in use"
                ]);
                return;
            }

            // Hash and save the user in the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $userId = UserModel::createUser($username, $email, $hashedPassword);
        } catch (PDOException) {
            $res->status(500)->json([
                'success' => false,
                'message' => "Database connection failed, try later"
            ]);
            return;
        }

        if (!$userId) {
            $res->status(500)->json([
                'success' => false,
                'message' => "Registration failed"
            ]);
            return;
        }

        // Start session and set user info
        session_start();
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_role'] = 1; // Default role is 'user'

        // Return success response
        $res->status(201)->json([
            'success' => true,
            'message' => 'Registration successful',
            'user' => [
                'id' => $userId,
                'username' => $username,
                'email' => $email,
                'role_id' => 1
            ]
        ]);
    }

    public static function logout(Request $req, Response $res)
    {
        session_start();
        session_destroy();

        $res->status(200)->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
