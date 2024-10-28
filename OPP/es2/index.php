<?php

declare(strict_types=1);
require_once "./classes/Book.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <style>
        .container {
            display: flex;
            gap: 2rem;
        }
    </style>
</head>

<body>
    <?php
    $books = [
        ["name" => "The Lord of the Rings", "price" => 20.5, "bookshelfNumber" => "A1", "pages" => 1000, "editor" => "HarperCollins"],
        ["name" => "Harry Potter", "price" => 15.5, "bookshelfNumber" => "A2", "pages" => 800, "editor" => "Bloomsbury"],
        ["name" => "The Hobbit", "price" => 10.5, "bookshelfNumber" => "A3", "pages" => 500, "editor" => "HarperCollins"],
    ];

    foreach ($books as $book) : ?>
        <?php
        $bookObj = new Book();
        $bookObj->initialize($book["name"], $book["price"], $book["bookshelfNumber"], $book["pages"], $book["editor"]);
        ?>
        <div class="container">
            <div>
                <h1><?= $bookObj->getName() ?></h1>
                <p><?= $bookObj->show() ?></p>
            </div>

            <div>
                <?php $bookObj->applyDiscount(); ?>
                <h1><?= $bookObj->getName() ?> with discount</h1>
                <p><?= $bookObj->show() ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</body>

</html>