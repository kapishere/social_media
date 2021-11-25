    <?php
require 'require/config.php';
if(isset($_SESSION['email']))
{
$userLoggedIn=$_SESSION['email']; 
$userDetails=mysqli_query($conn, "SELECT * FROM users WHERE email='$userLoggedIn'");
$user = mysqli_fetch_array($userDetails);
}
else header("Location: login.php");


?>
    <html lang="pl">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/styleHeader.css">
        <script src="https://kit.fontawesome.com/39dd631a16.js" crossorigin="anonymous"></script>

    </head>

    <body>
        <div class="top-bar">
            <div class="logo">
                <a href="index.php">Strona główna</a>
            </div>

            <nav>


                <a href=""><i class="fas fa-envelope fa-2x"></i></a>
                <a href=""><i class="far fa-bell fa-2x"></i></a>
                <a href="<?php echo $user['username']?>"><i class="far fa-user fa-2x"></i></a>
                <a href=""><i class="fas fa-cogs fa-2x"></i></a>
                <a href="logout.php"><i class="fas fa-sign-out-alt fa-2x"></i></a>

            </nav>

        </div>
        <div class="wrapper">