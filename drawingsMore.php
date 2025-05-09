<?php
session_start();
define("BASE_URL", "/app/");

include("includes/databaseConn.inc.php");

if (isset($_SESSION["drawing_id"])) {
    // Get the design_id from the session
    $drawing_id = $_SESSION["drawing_id"];

    // Fetch the specific design data based on the session's design_id
    $sql = "SELECT * FROM drawing WHERE drawing_id = :drawing_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':drawing_id', $drawing_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the result was found
    if ($result) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>drawing Details</title>
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
            <?php include("header.php"); ?>

            <div class="designMore">
                <section>
                    <!-- Display the design image -->
                    <img src="<?php echo $result["drawing_image"]; ?>" alt="">
                </section>
                <section>
                    <!-- Display the design title -->
                    <h2><?php echo $result["drawing_title"]; ?></h2> 
                    <!-- Display the design description -->
                    <p><?php echo nl2br($result["drawing_descriotion"]); ?></p>
                </section>

            </div>
         <?php include("footer.php");?>

        </body>
        </html>
        <?php
    } else {
        echo "Design not found.";
    }
} else {
    session_destroy();
    header("location: drawings.php");
    exit();
}
?>
