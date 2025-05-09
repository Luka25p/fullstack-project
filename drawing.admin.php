<?php
session_start();

include "includes/databaseConn.inc.php";
include "includes/drawings.inc.php";
include "includes/deletedrawings.inc.php";
include "includes/uploadDrawings.inc.php";

if(isset($_POST["logOut"])){
    session_destroy();
    header("location: login.php");
    exit();
}

if(isset($_SESSION['user_id']) && isset($_SESSION['username'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>drawing | admin</title>
    <link rel="stylesheet" href="scss/style.css">
    <link rel="stylesheet" href="scss/reset.css">
</head>
<body>
<div class="admin-form-container">
    <form action="drawing.admin.php" method="POST" enctype="multipart/form-data" class="news-form">
        <label for="title">drawing Title:</label>
        <input type="text" id="title" name="drawing_title" required placeholder="drawing title">

        <label for="text">drawing Text:</label>
        <textarea id="text" name="drawing_text" required></textarea>

        <label for="file-upload" class="custom-file-upload">Upload Image +</label>
        <input type="file" id="file-upload" name="image" accept="image/*" required >

        <input type="submit" name="drawing" value="add drawing">
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
                <form action="drawing.admin.php" method="post">
                   <input type="submit" value="delete post" name="delete">
                   <input type="text" name="drawing_id" value="<?php echo $row["drawing_id"];?>">
                </form>
                <h2><?php echo $row["drawing_title"];?></h2> 
                <p><?php echo $row["drawing_descriotion"];?></p>
                <img src="<?php echo $row["drawing_image"];?>" alt="">            
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