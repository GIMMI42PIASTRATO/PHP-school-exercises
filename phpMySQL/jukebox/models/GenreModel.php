<?php

declare(strict_types=1);
include_once __DIR__ . "/../lib/Model.php";

class GenreModel extends Model
{
    /**
     * Get all genres
     */
    public static function getAllGenres(): array
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT id, nome FROM generi ORDER BY nome");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get genre by ID
     */
    public static function getGenreById(int $id): array|false
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT id, nome FROM generi WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Create a new genre
     */
    public static function createGenre(string $name): int|false
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("INSERT INTO generi (nome) VALUES (:nome)");
        $stmt->bindParam(':nome', $name);

        if ($stmt->execute()) {
            return (int)$conn->lastInsertId();
        }

        return false;
    }
}
