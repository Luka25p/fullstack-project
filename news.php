<?php
    include "includes/databaseConn.inc.php";
    include "includes/news.inc.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>silhouette | news</title>
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
    <div class="news-main">
        <h2>news</h2>
        <?php foreach($result as $row):?>
        <div class="news-container">
            <div class="news-cards">
                <h2><?php echo $row["news_title"];?></h2> 
                <p><?php echo $row["news_text"];?></p>
                <img src="<?php echo $row["news_image"];?>" alt="">            
                <p class="news-date"><?php echo $row["news_date"];?></p>
            </div>
        </div>
        <?php endforeach;?>
        </div>
</body>
</html>