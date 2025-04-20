<?php

declare(strict_types=1);

class AuthModel
{
    private static function getConnection(): PDO
    {
        include_once __DIR__ . "/config/db.php";

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Find a user by email
     */
    public static function findUserByEmail(string $email): array|false
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT id, email, password, name FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Check if an email already exists
     */
    public static function emailExists(string $email): bool
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return (bool)$stmt->fetchColumn();
    }

    /**
     * Create a new user
     */
    public static function createUser(string $name, string $email, string $hashedPassword): int|false
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("
            INSERT INTO users (name, email, password, created_at) 
            VALUES (:name, :email, :password, NOW())
        ");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            return (int)$conn->lastInsertId();
        }

        return false;
    }
}
