<?php 
session_start();

include("includes/databaseConn.inc.php");
include("includes/designs.inc.php");



if (isset($_POST["designm"])) {
    $_SESSION['design_id'] = $_POST['design_id'];

    $design_name = $_SESSION["design_title"];
    $design_id = $_SESSION['design_id'];
    header("location: designsMore?id=$design_id&name=$design_name");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>silhouette | design</title>
    <link rel="icon" href="images/icon.ico" type="image/png">

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
                $_SESSION["design_id"] = $row["design_id"];
                $_SESSION["design_title"] = $row["design_title"];?>
            <div class="img-wrapper">
                <img src="<?php echo $row["design_image"];?>" alt="">
                <form action="designs.php" method="post">
                    <input type="hidden" name="design_id" value="<?php echo $row["design_id"]; ?>">
                    <input type="submit" class="overlay" value="Read more" name="designm">
                </form>
            </div>
            <?php endforeach;?>
        </div>
    <?php include("footer.php");?>

    </div>
</body>
</html>
