<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["delete"])) {
    $delete_id = $_POST["drawing_id"];

    $stmt = $pdo->prepare("SELECT drawing_image FROM drawing WHERE drawing_id = :id");
    $stmt->execute([
        'id' => $delete_id
    ]);

    $row = $stmt->fetch();

    if ($row && file_exists($row['drawing_image'])) {
        unlink($row['drawing_image']); 
    }

    // Now delete the record from DB
    $stmt = $pdo->prepare("DELETE FROM drawing WHERE drawing_id = :id");
    $stmt->execute([':id' => $delete_id]);

    header("location: ./drawing.admin.php");
    exit();
}