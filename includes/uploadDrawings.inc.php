<?php
require_once 'databaseConn.inc.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['drawing']) && isset($_FILES['image'])) {

    $title = htmlspecialchars(trim($_POST['drawing_title']));
    $text = htmlspecialchars(trim($_POST['drawing_text']));

    if (empty($title) || empty($text)) {
        die("Title and text cannot be empty.");
    }

    $target_dir = "images/";
    $file_name = time() . '_' . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $file_name;
    $image_path = $target_file;

    $file_size = $_FILES['image']['size'];
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    $max_size = 2 * 1024 * 1024; // 2MB

    if ($file_size > $max_size) {
        die("Image too large. Max size is 2MB.");
    }

    if (!in_array($file_type, $allowed_types)) {
        die("Invalid image type. Only JPG, JPEG, PNG, GIF allowed.");
    }

    if (!getimagesize($_FILES["image"]["tmp_name"])) {
        die("Uploaded file is not a valid image.");
    }

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        die("Failed to upload image.");
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO drawing (drawing_title, drawing_descriotion, drawing_image) VALUES (:title, :text, :image)");
        $stmt->execute([
            ':title' => $title,
            ':text' => $text,
            ':image' => $image_path
        ]);

        header("Location: drawing.admin.php?success=1");
        exit();

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
    header("location: ./designs.admin.php");
    exit();
}
