<?php
require_once 'databaseConn.inc.php'; // Make sure $pdo is defined in this file

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['design']) && isset($_FILES['image'])) {

    // Validate inputs
    $title = htmlspecialchars(trim($_POST['design_title']));
    $text = htmlspecialchars(trim($_POST['design_text']));

    if (empty($title) || empty($text)) {
        die("Title and text cannot be empty.");
    }

    // Handle file
    $target_dir = "images/";
    $file_name = time() . '_' . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $file_name;
    $image_path = $target_file;

    $file_size = $_FILES['image']['size'];
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    $max_size = 2 * 1024 * 1024; // 2MB

    // Validate image size
    if ($file_size > $max_size) {
        die("Image too large. Max size is 2MB.");
    }

    // Validate file type
    if (!in_array($file_type, $allowed_types)) {
        die("Invalid image type. Only JPG, JPEG, PNG, GIF allowed.");
    }

    // Validate actual image
    if (!getimagesize($_FILES["image"]["tmp_name"])) {
        die("Uploaded file is not a valid image.");
    }

    // Create images folder if it doesn't exist
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Move uploaded file
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        die("Failed to upload image.");
    }

    // Insert into database
    try {
        $stmt = $pdo->prepare("INSERT INTO design (design_title, design_descriotion, design_image) VALUES (:title, :text, :image)");
        $stmt->execute([
            ':title' => $title,
            ':text' => $text,
            ':image' => $image_path
        ]);

        // Redirect on success
        header("Location: designs.admin.php?success=1");
        exit();

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
    header("location: ./designs.admin.php");
    exit();
}
