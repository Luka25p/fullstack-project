<?php
session_start();

include "includes/databaseConn.inc.php";
include "includes/designs.inc.php";
include "includes/deleteDesigns.inc.php";
include "includes/uploadDesigns.inc.php";
include("includes/login.inc.php");



include("includes/signout.inc.php");


if (isLoggedIn()){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="images/icon.ico" type="image/png">
    <link rel="stylesheet" href="scss/style.css">
    <link rel="stylesheet" href="scss/reset.css">
</head>
<body>
<div class="admin-form-container">
    <form action="designs.admin.php" method="POST" enctype="multipart/form-data" class="news-form">
        <label for="title">design Title:</label>
        <input type="text" id="title" name="design_title" required placeholder="design title">

        <label for="text">design Text:</label>
        <textarea id="text" name="design_text" required></textarea>

        <label for="file-upload" class="custom-file-upload">Upload Image +</label>
        <input type="file" id="file-upload" name="image" accept="image/*" required >

        <input type="submit" name="design" value="add news">
    </form>        
</div>
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
<div class="news-main">
        <h2>designs</h2>
        <?php foreach($result as $row):?>
        <div class="news-container">
            <div class="news-cards">
                <form action="designs.admin.php" method="post">
                   <input type="submit" value="delete post" name="delete">
                   <input type="text" name="design_id" value="<?php echo $row["design_id"];?>">
                </form>
                <h2><?php echo $row["design_title"];?></h2> 
                <p><?php echo $row["design_descriotion"];?></p>
                <img src="<?php echo $row["design_image"];?>" alt="">            
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