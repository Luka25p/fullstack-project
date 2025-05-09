<?php 
session_start();

include("includes/databaseConn.inc.php");
include("includes/drawings.inc.php");
include("includes/drawingsMore.inc.php");



if (isset($_POST["drawingm"])) {
    $_SESSION['drawing_id'] = $_POST['drawing_id'];

    header("location: ./drawingsMore.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>silhouette | drawing</title>
        <!-- google font lato -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <!-- google font end -->
        <link rel="stylesheet" href="scss/reset.css">
        <link rel="stylesheet" href="scss/style.css">
</head>
<body>
    <?php include("header.php");?>

    <div class="container2">
        <div class="column">
            <?php foreach($result as $row):
                $_SESSION["drawing_id"] = $row["drawing_id"]?>
            <div class="img-wrapper">
                <img src="<?php echo $row["drawing_image"];?>" alt="">
                <form action="drawings.php" method="post">
                    <input type="hidden" name="drawing_id" value="<?php echo $row["drawing_id"]; ?>">
                    <input type="submit" class="overlay" value="Read more" name="drawingm">
                </form>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</body>
</html>
