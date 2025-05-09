<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["delete"])) {
    $delete_id = $_POST["news_id"];

    $stmt = $pdo->prepare("SELECT news_image FROM news WHERE news_id = :id");
    $stmt->execute([
        'id' => $delete_id
    ]);

    $row = $stmt->fetch();

    if ($row && file_exists($row['news_image'])) {
        unlink($row['news_image']); 
    }

    // Now delete the record from DB
    $stmt = $pdo->prepare("DELETE FROM news WHERE news_id = :id");
    $stmt->execute([':id' => $delete_id]);

    header("location: ./news.admin.php");
    exit();
}