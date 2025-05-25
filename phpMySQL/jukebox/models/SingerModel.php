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

    // Add this new method to the existing SingerModel class

    /**
     * Get all songs by singer ID
     */
    public static function getSongsBySinger(string $singerId): array
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("
        SELECT c.id, c.nome, c.data_rilascio, c.durata, c.genere, c.copertina, c.percorso_audio, g.nome as nome_genere
        FROM canzoni c
        JOIN interpreta i ON c.id = i.id_canzone
        JOIN generi g ON c.genere = g.id
        WHERE i.id_cantante = :id_cantante
        ORDER BY c.data_rilascio DESC
    ");
        $stmt->bindParam(':id_cantante', $singerId);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Update a singer
     */
    public static function updateSinger(array $singerData): bool
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("
        UPDATE cantanti 
        SET nickname = :nickname, 
            immagine_profilo = :immagine_profilo, 
            biografia = :biografia, 
            attivo = :attivo
        WHERE id = :id
    ");

        $stmt->bindParam(':id', $singerData['id']);
        $stmt->bindParam(':nickname', $singerData['nickname']);
        $stmt->bindParam(':immagine_profilo', $singerData['immagine_profilo']);
        $stmt->bindParam(':biografia', $singerData['biografia']);
        $stmt->bindParam(':attivo', $singerData['attivo'], PDO::PARAM_BOOL);

        return $stmt->execute();
    }
}
