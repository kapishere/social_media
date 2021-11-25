<?php  
require 'require/config.php';
?>



<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="page">
  
    <form action="" method="POST">
 <h1>Zarejestruj się</h1>
     <div class="form-box">
          <label for="fname">Imie:</label>
		<input type="text" name="fname" placeholder="Imie" ><br>
     </div> <div class="form-box">
          <label for="lname">Nazwisko:</label>
		<input type="text" name="lname" placeholder="Nazwisko"><br>
     </div> <div class="form-box">
          <label for="email">E-mail:</label>
		<input type="text" name="email" placeholder="E-mail"><br>
     </div> <div class="form-box">
          <label for="password">Hasło:</label>
		<input type="password" name="password" placeholder="Hasło" ><br>
     </div> <div class="form-box">
          <label for="password2">Potwierdź hasło:</label>
		<input type="password" name="password2" placeholder="Potwierdź hasło" ><br>
     </div> <div class="form-box">
		<input type="submit" name="submitRegister" value="Zarejestruj się"><br></div>
  
 <div class="form-box">
    <?php
     if(isset($_POST['submitRegister'])) {
    $email=$_POST['email'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];

    $repeatChecker = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
    $repeatedEmails= mysqli_num_rows($repeatChecker);

    if(empty($fname) || empty($lname) || empty($email) || empty($password2) || empty($password)) echo '<p>wypełnij dane</p>';else{
   if(!filter_var($email, FILTER_VALIDATE_EMAIL)) echo "<p>błędny email</p>"; else if($repeatedEmails > 0) echo "<p>email jest już używany</p>"; else	{	
if($password!=$password2) echo '<p>Hasła się róznia</p>'; else{
    $hashedPassword =password_hash($password, PASSWORD_DEFAULT);
 $query = mysqli_query($conn, "INSERT INTO users VALUES ('', '$fname', '$lname', '$email', '$hashedPassword')");
 header("Location: login.php");
		 exit();
}}}}
?>
  </div> <div class="form-box">
   <button>  <a href="login.php">Masz już konto zaloguj się</a></button></div>
	</form></div>
</body>
</html>