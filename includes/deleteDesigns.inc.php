<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["delete"])) {
    $delete_id = $_POST["design_id"];

    $stmt = $pdo->prepare("SELECT design_image FROM design WHERE design_id = :id");
    $stmt->execute([
        'id' => $delete_id
    ]);

    $row = $stmt->fetch();

    if ($row && file_exists($row['design_image'])) {
        unlink($row['design_image']);
    }

    $stmt = $pdo->prepare("DELETE FROM design WHERE design_id = :id");
    $stmt->execute([':id' => $delete_id]);

    header("location: ./designs.admin.php");
    exit();
}