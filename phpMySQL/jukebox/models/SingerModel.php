<?php

declare(strict_types=1);
require_once __DIR__ . "/../lib/Model.php";

class SingerModel extends Model
{
    /**
     * Create a new singer
     */
    public static function createSinger(array $singerData): bool
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("
            INSERT INTO cantanti (id, nickname, immagine_profilo, biografia, attivo) 
            VALUES (:id, :nickname, :immagine_profilo, :biografia, :attivo)
        ");

        $stmt->bindParam(':id', $singerData['id']);
        $stmt->bindParam(':nickname', $singerData['nickname']);
        $stmt->bindParam(':immagine_profilo', $singerData['immagine_profilo']);
        $stmt->bindParam(':biografia', $singerData['biografia']);
        $stmt->bindParam(':attivo', $singerData['attivo'], PDO::PARAM_BOOL);

        return $stmt->execute();
    }

    /**
     * Get all singers
     */
    public static function getAllSingers(): array
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT id, nickname, immagine_profilo, biografia, attivo FROM cantanti");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get singer by ID
     */
    public static function getSingerById(string $id): array|false
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT id, nickname, immagine_profilo, biografia, attivo FROM cantanti WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Delete a singer by ID
     */
    public static function deleteSinger(string $id): bool
    {
        $conn = self::getConnection();
        try {
            $conn->beginTransaction();

            // First delete from interpreta (junction table)
            $stmt = $conn->prepare("DELETE FROM interpreta WHERE id_cantante = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Then delete the singer
            $stmt = $conn->prepare("DELETE FROM cantanti WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $result = $stmt->execute();

            $conn->commit();
            return $result;
        } catch (PDOException $e) {
            $conn->rollBack();
            throw $e;
        }
    }
}
