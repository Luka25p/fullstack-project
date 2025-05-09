<?php
session_start();

include "includes/databaseConn.inc.php";
include "includes/news.inc.php";
include "includes/deletePost.inc.php";
include "includes/uploadPost.inc.php";
include("includes/signout.inc.php");
include("includes/login.inc.php");



if (isLoggedIn()){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>news | admin</title>
    <link rel="icon" href="images/icon.ico" type="image/png">
    <link rel="stylesheet" href="scss/style.css">
    <link rel="stylesheet" href="scss/reset.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="designs.admin.php">designs</a></li>
            <li><a href="news.admin.php">news</a></li>
            <li><a href="drawing.admin.php">drawing</a></li>
        </ul>        
        <form action="news.admin.php" method="post" class="logOut">
            <input type="submit" value="log out" name="logOut">
        </form>
    </nav>
</header>
<div class="admin-form-container">
    <form action="news.admin.php" method="POST" enctype="multipart/form-data" class="news-form">
        <label for="title">News Title:</label>
        <input type="text" id="title" name="title" required placeholder="news title">

        <label for="text">News Text:</label>
        <textarea id="text" name="text" required placeholder="news text"></textarea>

        <label for="file-upload" class="custom-file-upload">Upload Image +</label>
        <input type="file" id="file-upload" name="image" accept="image/*" required >

        <input type="submit" value="add news">
    </form>        
</div>

<div class="news-main">
        <h2>news</h2>
        <?php foreach($result as $row):?>
        <div class="news-container">
            <div class="news-cards">
                <form action="news.admin.php" method="post">
                   <input type="submit" value="delete post" name="delete">
                   <input type="text" name="news_id" value="<?php echo $row["news_id"];?>">
                </form>
                <h2><?php echo $row["news_title"];?></h2> 
                <p><?php echo nl2br(htmlspecialchars(str_replace('\\n', "\n", $row["news_text"]))); ?></p>
                <img src="<?php echo $row["news_image"];?>" alt="">            
                <p class="news-date"><?php echo $row["news_date"];?></p>
            </div>
        </div>
        <?php endforeach;?>
        </div>
</body>
</html>
<?php
}else{
    header("location: login.php");
    exit();
    session_destroy();
}

?>