<?php  
require 'config.php';
require 'db.php';
?>



<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page">
    <form action="" method="POST">
		<input type="text" name="emailLogin" placeholder="E-mail"><br>
		<input type="password" name="passwordLogin" placeholder="Haslo" ><br>
		<input type="submit" name="submitLogin" value="Register"><br>
	</form>
    <form action="" method="POST">
		<input type="text" name="fname" placeholder="Imie" ><br>
		<input type="text" name="lname" placeholder="Nazwisko"><br>
		<input type="text" name="email" placeholder="E-mail"><br>
		<input type="password" name="password" placeholder="Haslo" ><br>
		<input type="password" name="password2" placeholder="Potwierdz haslo" ><br>
		<input type="submit" name="submitRegister" value="Register"><br>
	</form>
    <?php
     if(isset($_POST['submitRegister'])) {
    $email=$_POST['email'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];

    $repeatChecker = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
    $repeatedEmails= mysqli_num_rows($repeatChecker);

    if(empty($fname) || empty($lname) || empty($email) || empty($password2) || empty($password)) echo 'wypelnij dane';else{
   if(!filter_var($email, FILTER_VALIDATE_EMAIL)) echo "bledny email"; else if($repeatedEmails > 0) echo "Email jest juz uzywany"; else	{	
if($password!=$password2) echo 'Hasla sie roznia'; else{
    $hashedPassword =password_hash($password, PASSWORD_DEFAULT);
 $query = mysqli_query($conn, "INSERT INTO users VALUES ('', '$fname', '$lname', '$email', '$hashedPassword')");
}}}}
 if(isset($_POST['submitLogin'])) {
    $emailLog=$_POST['emailLogin'];
      $passwordLog=$_POST['passwordLogin'];

	$accountExists = mysqli_query($conn, "SELECT email ,password FROM users WHERE email='$emailLog'");
	$accountExistsQuery = mysqli_num_rows($accountExists);

	if($accountExistsQuery > 0) {
        $row = mysqli_fetch_array($accountExists);
        if (password_verify($passwordLog, $row['password']))
        {
				$_SESSION['email'] = $emailLog;
		 header("Location: index.php");
		 exit();
        }
	echo 'Bledne haslo';
    
	}else echo 'Bledny login';
   
        
	

 }
?></div>
</body>
</html>