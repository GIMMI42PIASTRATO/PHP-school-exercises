<?php

declare(strict_types=1);
include_once __DIR__ . "/../lib/Model.php";

class SongModel extends Model
{
    /**
     * Create a new song
     */
    public static function createSong(array $songData): bool
    {
        $conn = self::getConnection();

        try {
            // Start transaction
            $conn->beginTransaction();

            // Insert song
            $stmt = $conn->prepare("
                INSERT INTO canzoni (id, nome, data_rilascio, durata, genere, copertina, percorso_audio) 
                VALUES (:id, :nome, :data_rilascio, :durata, :genere, :copertina, :percorso_audio)
            ");

            $stmt->bindParam(':id', $songData['id']);
            $stmt->bindParam(':nome', $songData['nome']);
            $stmt->bindParam(':data_rilascio', $songData['data_rilascio']);
            $stmt->bindParam(':durata', $songData['durata'], PDO::PARAM_INT);
            $stmt->bindParam(':genere', $songData['genere'], PDO::PARAM_INT);
            $stmt->bindParam(':copertina', $songData['copertina']);
            $stmt->bindParam(':percorso_audio', $songData['percorso_audio']);

            $stmt->execute();

            // Associate singers with the song
            if (!empty($songData['singers'])) {
                $stmtSinger = $conn->prepare("
                    INSERT INTO interpreta (id_cantante, id_canzone) 
                    VALUES (:id_cantante, :id_canzone)
                ");

                foreach ($songData['singers'] as $singerId) {
                    $stmtSinger->bindParam(':id_cantante', $singerId);
                    $stmtSinger->bindParam(':id_canzone', $songData['id']);
                    $stmtSinger->execute();
                }
            }

            // Commit transaction
            $conn->commit();
            return true;
        } catch (PDOException $e) {
            // Rollback on error
            $conn->rollBack();
            throw $e;
        }
    }

    /**
     * Get all songs
     */
    public static function getAllSongs(): array
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("
            SELECT c.id, c.nome, c.data_rilascio, c.durata, c.genere, c.copertina, c.percorso_audio, g.nome as nome_genere
            FROM canzoni c
            JOIN generi g ON c.genere = g.id
            ORDER BY c.nome
        ");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get song by ID with singers
     */
    public static function getSongById(string $id): array|false
    {
        $conn = self::getConnection();

        // Get song data
        $stmt = $conn->prepare("
            SELECT c.id, c.nome, c.data_rilascio, c.durata, c.genere, c.copertina, c.percorso_audio, g.nome as nome_genere
            FROM canzoni c
            JOIN generi g ON c.genere = g.id
            WHERE c.id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $song = $stmt->fetch();
        if (!$song) {
            return false;
        }

        // Get singers for this song
        $stmtSingers = $conn->prepare("
            SELECT c.id, c.nickname 
            FROM cantanti c
            JOIN interpreta i ON c.id = i.id_cantante
            WHERE i.id_canzone = :id_canzone
        ");
        $stmtSingers->bindParam(':id_canzone', $id);
        $stmtSingers->execute();

        $song['singers'] = $stmtSingers->fetchAll();

        return $song;
    }

    /**
     * Delete a song by ID
     */
    public static function deleteSong(string $id): bool
    {
        $conn = self::getConnection();
        try {
            $conn->beginTransaction();

            // First delete from interpreta (junction table)
            $stmt = $conn->prepare("DELETE FROM interpreta WHERE id_canzone = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Then delete the song
            $stmt = $conn->prepare("DELETE FROM canzoni WHERE id = :id");
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
