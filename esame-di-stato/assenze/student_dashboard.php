<?php
require_once "auth.php";

if (!isLoggedIn()) {
    header("Location: auth-form.php");
    exit;
}

if (!isStudent()) {
    header("Location: teacher_dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h1>Student Dashboard</h1>
    <p>Welcome, <?php echo $_SESSION["nome"]; ?>!</p>
</body>

</html>