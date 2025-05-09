<?php

$loginError = "";

if (isset($_POST["login"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $sql = "SELECT * FROM admin WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user["PASSWORD"] === $password) {
        // Valid login
        $_SESSION['user_id'] = $user["user_id"];
        $_SESSION['username'] = $user["username"];
        header("Location: ./news.admin.php");
        exit();
    } else {
        // Invalid login
        $loginError = "Incorrect username or password";
    }
}
