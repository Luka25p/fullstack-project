<?php

$loginError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["login"])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        $loginError = "Username and password are required.";
    } elseif (strlen($username) > 50 || strlen($password) > 255) {
        $loginError = "Invalid input length.";
    } else {
        $sql = "SELECT * FROM admin WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $username]);

        $user = $stmt->fetch();

        if ($user && $user["PASSWORD"] === $password) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user["user_id"];
            $_SESSION['username'] = $user["username"];
            header("Location: ./news.admin.php");
            exit();
        } else {
            $loginError = "Incorrect username or password.";
        }
    }
}

function isLoggedIn() {
    return isset($_SESSION['user_id'], $_SESSION['username']);
}

