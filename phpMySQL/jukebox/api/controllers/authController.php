<?php

require_once __DIR__ . "/../models/authModel.php";

class AuthController
{
    public static function login(Request $req, Response $res)
    {
        $email = $req->body['email'] ?? '';
        $password = $req->body['password'] ?? '';

        // Validate input
        if (empty($email) || empty($password)) {
            return $res->status(400)->json([
                'success' => false,
                'message' => 'Email and password are required'
            ]);
        }

        // Attempt login
        $user = AuthModel::findUserByEmail($email);

        if (!$user) {
            return $res->status(401)->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ]);
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            return $res->status(401)->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ]);
        }

        // Start session and set user info
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        // Return success response
        return $res->status(200)->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'id' => $user['id'],
                'email' => $user['email']
            ]
        ]);
    }
}
