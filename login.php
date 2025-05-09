<?php
session_start();

include("includes/databaseConn.inc.php");
include("includes/login.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>silhouette</title>

    <!-- google font lato -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- google font end -->
    <link rel="stylesheet" href="scss/reset.css">
    <link rel="stylesheet" href="scss/style.css">
</head>
<body>
    <div class="logIn">
    <form action="login.php" method="post">
    <?php if (!empty($loginError)): ?>
    <div class="error"><?= htmlspecialchars($loginError) ?></div>
    <?php endif; ?>
        <section>
            <label for="username">username</label>
            <input type="text" name="username">
        </section>
        <section>
            <label for="password">password</label>
            <input type="password" name="password">
        </section>
        <input type="submit" name="login">
    </form>
    </div>


</body>
</html>