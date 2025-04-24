<?php

declare(strict_types=1);
include_once __DIR__ . "/../lib/Model.php";

class UserModel extends Model
{
    /**
     * Find a user by username
     */
    public static function findUserByUsername(string $username): array|false
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT id, password, username, email, ruolo_id, data_registrazione, attivo FROM utenti WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Find a user by email
     */
    public static function findUserByEmail(string $email): array|false
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT id, password, username, email, ruolo_id, data_registrazione, attivo FROM utenti WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Find a user by id
     */
    public static function findUserById(int $userId): array|false
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT id, password, username, email, ruolo_id, data_registrazione, attivo FROM utenti WHERE id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Check if a username already exists
     */
    public static function userExists(string $username): bool
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM utenti WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return (bool)$stmt->fetchColumn();
    }

    /**
     * Check if an email already exists
     */
    public static function emailExists(string $email): bool
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM utenti WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return (bool)$stmt->fetchColumn();
    }

    /**
     * Create a new user
     */
    public static function createUser(string $username, string $email, string $hashedPassword): int|false
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("
            INSERT INTO utenti (username, email, password, ruolo_id) 
            VALUES (:username, :email, :password, 1)
        ");

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            return (int)$conn->lastInsertId();
        }

        return false;
    }

    /**
     * Get user role information
     */
    public static function getUserRole(int $roleId): array|false
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT id, nome FROM ruoli WHERE id = :role_id");
        $stmt->bindParam(':role_id', $roleId);
        $stmt->execute();

        return $stmt->fetch();
    }
}
