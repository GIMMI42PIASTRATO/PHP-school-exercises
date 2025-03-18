<?php
session_start();
$conn = null;

function connectDB()
{
    global $conn;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "scuola";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = sanitize($_POST["username"]);
    $password = sanitize($_POST["password"]);
    $userType = sanitize($_POST["userType"]);

    $conn = connectDB();

    if ($userType == "studente") {
        $sql = "SELECT cf, nome, username, id_classe FROM Studente WHERE username = ? AND password = ?";
    } else {
        $sql = "SELECT cf, nome, username FROM docente WHERE username = ? AND password = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("?", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        $_SESSION["userType"] = $userType;
        $_SESSION["nome"] = $row["nome"];
        $_SESSION["cf"] = $row["cf"];

        if ($userType == "studente") {
            $_SESSION["classe_id"] = $row["id_classe"];
            header("Location: student_dashboard.php");
        } else {
            header("Location: teacher_dashboard.php");
        }
    } else {
        $error = "Username o password non validi";
    }

    $stmt->close();
    $conn->close();
}

function isLoggedIn()
{
    return isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
}

function isStudent()
{
    return isLoggedIn() && $_SESSION["userType"] === "studente";
}

function isTeacher()
{
    return isLoggedIn() && $_SESSION["userType"] === "docente";
}

function logout()
{
    session_start();
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
    exit;
}

if (isset($_GET['logout'])) {
    logout();
}
