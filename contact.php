<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>silhouette | contact</title>
    <link rel="icon" href="images/icon.ico" type="image/png">

    <!-- google font lato -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- google font end -->
    <link rel="stylesheet" href="scss/reset.css">
    <link rel="stylesheet" href="scss/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include("header.php");?>
    <main>
        <div class="contact">
            <h1>Contact</h1>
            <p>Choose your preferred method to reach out:</p>
            <div class="contact-options">
                <a href="viber://chat?number=+1234567890" class="contact-box viber" target="_blank">
                    <i class="fab fa-viber"></i>
                    <span>Viber</span>
                </a>
                <a href="https://wa.me/1234567890" class="contact-box whatsapp" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp</span>
                </a>
                <a href="https://m.me/username" class="contact-box messenger" target="_blank">
                    <i class="fab fa-facebook-messenger"></i>
                    <span>Messenger</span>
                </a>
            </div>
        </div>
    </main>
   
    <?php include("footer.php")?>
</body>
</html>