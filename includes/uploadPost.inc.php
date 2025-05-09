<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $title = htmlspecialchars($_POST['title']);
    $text = htmlspecialchars($_POST['text']);

    $target_dir = "images/";
    $file_name = time() . '_' . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $file_name;
    $image_path = $target_file;

    $file_size = $_FILES['image']['size'];
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    $max_size = 2 * 1024 * 1024;

    if ($file_size > $max_size) {
        echo "Image too large. Max size is 2MB.";
        exit();
    }

    if (!in_array($file_type, $allowed_types)) {
        echo "Invalid image type.";
        exit();
    }

    if (!getimagesize($_FILES["image"]["tmp_name"])) {
        echo "File is not a valid image.";
        exit();
    }

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Failed to upload image.";
        exit();
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO news (news_title, news_text, news_image) VALUES (:title, :text, :image)");
        $stmt->execute([
            ':title' => $title,
            ':text' => $text,
            ':image' => $image_path
        ]);
    } catch (PDOException $e) {
        echo "DB insert error: " . $e->getMessage();
    }
    header("location: ./news.admin.php");
    exit();
}