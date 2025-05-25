<?php

require_once __DIR__ . "/../models/SingerModel.php";
require_once __DIR__ . "/../lib/Controller.php";

class SingersController
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
        $nickname = $req->body['nickname'] ?? '';
        $biography = $req->body['biography'] ?? '';
        $active = isset($req->body['active']) ? true : false;

        // Generate unique ID for singer
        $singerId = uniqid('singer_', true);

        // Handle image upload
        $imagePath = null;
        // Check if the user has uploaded the image and if there aren't any error
        if (isset($_FILES['singer_image']) && $_FILES['singer_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/uploads/singers/';

            // Create directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Make the filename by using the singer_id and the uploaded file extension es: singer_ksaldsafjdlajfdlajkfd.png
            $fileName = $singerId . '.' . pathinfo($_FILES['singer_image']['name'], PATHINFO_EXTENSION);
            $uploadFile = $uploadDir . $fileName;

            // mv the img from /tmp/phpYzdqkD to /public/uploads/singers/singer_ksaldsafjdlajfdlajkfd.png
            if (move_uploaded_file($_FILES['singer_image']['tmp_name'], $uploadFile)) {
                $imagePath = 'uploads/singers/' . $fileName;
            }
        }

        // Validate data
        if (empty($nickname)) {
            return $res->status(400)->json([
                'success' => false,
                'message' => 'Singer name is required'
            ]);
        }

        // Save singer to database
        try {
            $result = SingerModel::createSinger([
                'id' => $singerId,
                'nickname' => $nickname,
                'immagine_profilo' => $imagePath,
                'biografia' => $biography,
                'attivo' => $active
            ]);

            if ($result) {
                // Instead of returning JSON, redirect to singer page
                return $res->redirect("../../dashboard/singer/" . $singerId);
            } else {
                return $res->status(500)->json([
                    'success' => false,
                    'message' => 'Failed to create singer'
                ]);
            }
        } catch (Exception $e) {
            return $res->status(500)->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }

    // Add a method to display singer details
    public static function singerDetails(Request $req, Response $res)
    {
        session_start();

        // Check if user is authenticated
        if (!isset($_SESSION["user_id"])) {
            return $res->redirect("../auth/sign-in");
        }

        // Get singer ID from route params
        $singerId = $req->params['id'] ?? '';

        if (empty($singerId)) {
            return $res->redirect("../dashboard");
        }

        // Get singer data
        try {
            $singer = SingerModel::getSingerById($singerId);

            if (!$singer) {
                return $res->redirect("../dashboard");
            }

            // Get songs performed by this singer
            $songs = SingerModel::getSongsBySinger($singerId);

            // Render singer details view
            return $res->view("dashboard/singer", ["singer" => $singer, "songs" => $songs]);
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

        // Get singer ID from route params
        $singerId = $req->params['id'] ?? '';

        if (empty($singerId)) {
            return $res->status(400)->json([
                'success' => false,
                'message' => 'Singer ID is required'
            ]);
        }

        // Delete the singer from database
        try {
            $singer = SingerModel::getSingerById($singerId);
            if (!$singer) {
                return $res->status(404)->json([
                    'success' => false,
                    'message' => 'Singer not found'
                ]);
            }

            // Delete image file if exists
            if (!empty($singer['immagine_profilo'])) {
                $imagePath = __DIR__ . '/../public/' . $singer['immagine_profilo'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $result = SingerModel::deleteSinger($singerId);

            if ($result) {
                return $res->status(200)->json([
                    'success' => true,
                    'message' => 'Singer deleted successfully'
                ]);
            } else {
                return $res->status(500)->json([
                    'success' => false,
                    'message' => 'Failed to delete singer'
                ]);
            }
        } catch (Exception $e) {
            return $res->status(500)->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }

    public static function editSinger(Request $req, Response $res)
    {
        session_start();

        // Check if user is authenticated
        if (!isset($_SESSION["user_id"])) {
            return $res->redirect("../../auth/sign-in");
        }

        // Get singer ID from route params
        $singerId = $req->params['id'] ?? '';

        if (empty($singerId)) {
            return $res->redirect("../search");
        }

        // Get singer data
        try {
            $singer = SingerModel::getSingerById($singerId);

            if (!$singer) {
                return $res->redirect("../search");
            }

            // Render edit singer view with singer data
            return $res->view("dashboard/editSinger", ["singer" => $singer]);
        } catch (Exception $e) {
            return $res->view("errors/500");
        }
    }

    public static function update(Request $req, Response $res)
    {
        session_start();

        // Check if user is authenticated
        if (!isset($_SESSION["user_id"])) {
            return $res->status(401)->json([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
        }

        // Get singer ID from route params
        $singerId = $req->params['id'] ?? '';

        if (empty($singerId)) {
            return $res->status(400)->json([
                'success' => false,
                'message' => 'Singer ID is required'
            ]);
        }

        // Get form data
        $nickname = $req->body['nickname'] ?? '';
        $biography = $req->body['biography'] ?? '';
        $active = isset($req->body['active']) ? true : false;

        // Validate data
        if (empty($nickname)) {
            return $res->status(400)->json([
                'success' => false,
                'message' => 'Singer name is required'
            ]);
        }

        // Get existing singer data
        $singer = SingerModel::getSingerById($singerId);
        if (!$singer) {
            return $res->status(404)->json([
                'success' => false,
                'message' => 'Singer not found'
            ]);
        }

        // Handle image upload if a new image was provided
        $imagePath = $singer['immagine_profilo']; // Keep existing image by default
        if (isset($_FILES['singer_image']) && $_FILES['singer_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/uploads/singers/';

            // Create directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Delete old image if exists
            if (!empty($singer['immagine_profilo'])) {
                $oldImagePath = __DIR__ . '/../public/' . $singer['immagine_profilo'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Make the filename by using the singer_id and the uploaded file extension
            $fileName = $singerId . '.' . pathinfo($_FILES['singer_image']['name'], PATHINFO_EXTENSION);
            $uploadFile = $uploadDir . $fileName;

            // Move the uploaded image
            if (move_uploaded_file($_FILES['singer_image']['tmp_name'], $uploadFile)) {
                $imagePath = 'uploads/singers/' . $fileName;
            }
        }

        // Update singer in database
        try {
            $result = SingerModel::updateSinger([
                'id' => $singerId,
                'nickname' => $nickname,
                'immagine_profilo' => $imagePath,
                'biografia' => $biography,
                'attivo' => $active
            ]);

            if ($result) {
                return $res->redirect("../../../dashboard/singer/" . $singerId);
            } else {
                return $res->status(500)->json([
                    'success' => false,
                    'message' => 'Failed to update singer'
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
