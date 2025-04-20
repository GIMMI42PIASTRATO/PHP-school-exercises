<?php

require_once __DIR__ . "/../models/authModel.php";

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
        $user = AuthModel::findUserByEmail($email);

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

        // Start session and set user info
        session_start();
        $_SESSION['user_id'] = $user['id'];

        // Return success response
        $res->status(200)->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'id' => $user['id'],
                'email' => $user['email']
            ]
        ]);
    }

    public static function register(Request $req, Response $res)
    {
        // Get the body content
        $username = $req->body["username"] ?? '';
        $email = $req->body["email"] ?? '';
        $password = $req->body["password"] ?? '';

        // Validate input
        if (empty($username) || empty($email) || empty($password)) {
            $res->status(400)->json([
                'success' => false,
                'message' => 'Username, email and password are required'
            ]);
            return;
        }

        // Search if a user with the same email arleady exists
        $user = AuthModel::findUserByEmail($email);

        if ($user) {
            $res->status(409)->json([
                'success' => false,
                'message' => "Email arleady in use"
            ]);
            return;
        }

        // Hash and save the user in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        AuthModel::createUser($username, $email, $hashedPassword);

        // Call login to save user time
        self::login($req, $res);
    }
}
