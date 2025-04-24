<?php

require_once __DIR__ . "/../models/SongModel.php";
require_once __DIR__ . "/../models/GenreModel.php";
require_once __DIR__ . "/../lib/Controller.php";

class SongsController
{
    public static function create(Request $req, Response $res)
    {
        session_start();

        // Check if user is authenticated
        if (!isset($_SESSION["user_id"])) {
            return $res->status(401)->json([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
        }

        // Get form data
        $songName = $req->body['name'] ?? '';
        $releaseDate = $req->body['release_date'] ?? date('Y-m-d');
        $duration = (int)($req->body['duration'] ?? 0);
        $genre = (int)($req->body['genre'] ?? 0);
        $singers = $req->body['singers'] ?? [];

        // Generate unique ID for song
        $songId = uniqid('song_', true);

        // Validate data
        if (empty($songName)) {
            return $res->status(400)->json([
                'success' => false,
                'message' => 'Song name is required'
            ]);
        }

        if ($duration <= 0) {
            return $res->status(400)->json([
                'success' => false,
                'message' => 'Invalid duration'
            ]);
        }

        if ($genre <= 0) {
            return $res->status(400)->json([
                'success' => false,
                'message' => 'Genre is required'
            ]);
        }

        // Handle cover image upload
        $coverPath = null;
        if (isset($_FILES['song_cover']) && $_FILES['song_cover']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/uploads/covers/';

            // Create directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileName = $songId . '.' . pathinfo($_FILES['song_cover']['name'], PATHINFO_EXTENSION);
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['song_cover']['tmp_name'], $uploadFile)) {
                $coverPath = 'uploads/covers/' . $fileName;
            }
        }

        // Handle audio file upload
        $audioPath = null;
        if (isset($_FILES['audio_file']) && $_FILES['audio_file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/uploads/audio/';

            // Create directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileName = $songId . '.' . pathinfo($_FILES['audio_file']['name'], PATHINFO_EXTENSION);
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['audio_file']['tmp_name'], $uploadFile)) {
                $audioPath = 'uploads/audio/' . $fileName;
            } else {
                return $res->status(500)->json([
                    'success' => false,
                    'message' => 'Failed to upload audio file'
                ]);
            }
        }

        // Save song to database
        try {
            $result = SongModel::createSong([
                'id' => $songId,
                'nome' => $songName,
                'data_rilascio' => $releaseDate,
                'durata' => $duration,
                'genere' => $genre,
                'copertina' => $coverPath,
                'percorso_audio' => $audioPath,
                'singers' => $singers
            ]);

            if ($result) {
                // Redirect to song page
                return $res->redirect("../../dashboard/song/" . $songId);
            } else {
                return $res->status(500)->json([
                    'success' => false,
                    'message' => 'Failed to create song'
                ]);
            }
        } catch (Exception $e) {
            return $res->status(500)->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }

    public static function songDetails(Request $req, Response $res)
    {
        session_start();

        // Check if user is authenticated
        if (!isset($_SESSION["user_id"])) {
            return $res->redirect("../../auth/sign-in");
        }

        // Get song ID from route params
        $songId = $req->params['id'] ?? '';

        if (empty($songId)) {
            return $res->redirect("./dashboard");
        }

        // Get song data
        try {
            $song = SongModel::getSongById($songId);

            if (!$song) {
                return $res->redirect("../dashboard");
            }

            // Render song details view
            return $res->view("dashboard/song", ["song" => $song]);
        } catch (Exception $e) {
            return $res->view("errors/500");
        }
    }


    public static function delete(Request $req, Response $res)
    {
        session_start();

        // Check if user is authenticated
        if (!isset($_SESSION["user_id"])) {
            return $res->status(401)->json([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
        }

        // Get song ID from route params
        $songId = $req->params['id'] ?? '';

        if (empty($songId)) {
            return $res->status(400)->json([
                'success' => false,
                'message' => 'Song ID is required'
            ]);
        }

        // Delete the song from database
        try {
            $song = SongModel::getSongById($songId);
            if (!$song) {
                return $res->status(404)->json([
                    'success' => false,
                    'message' => 'Song not found'
                ]);
            }

            // Delete cover image file if exists
            if (!empty($song['copertina'])) {
                $coverPath = __DIR__ . '/../public/' . $song['copertina'];
                if (file_exists($coverPath)) {
                    unlink($coverPath);
                }
            }

            // Delete audio file if exists
            if (!empty($song['percorso_audio'])) {
                $audioPath = __DIR__ . '/../public/' . $song['percorso_audio'];
                if (file_exists($audioPath)) {
                    unlink($audioPath);
                }
            }

            $result = SongModel::deleteSong($songId);

            if ($result) {
                return $res->status(200)->json([
                    'success' => true,
                    'message' => 'Song deleted successfully'
                ]);
            } else {
                return $res->status(500)->json([
                    'success' => false,
                    'message' => 'Failed to delete song'
                ]);
            }
        } catch (Exception $e) {
            return $res->status(500)->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }
}
