<?php  
require 'config.php';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="page">
    <form action="" method="POST">
    <h1>Zaloguj się</h1>
         <div class="form-box">
              <label for="emailLogin">Email:</label>
		<input type="text" name="emailLogin" placeholder="E-mail"><br>
         </div>
        <div class="form-box">
          <label for="passwordLogin">Hasło:</label>
          <input type="password" name="passwordLogin" placeholder="Hasło" />
        </div>
         <div class="form-box">
		<input type="submit" name="submitLogin" value="Zaloguj się"><br>
   </div>
    <div class="form-box">
  
 
         
  <?php
 if(isset($_POST['submitLogin'])) {
    $emailLog=$_POST['emailLogin'];
      $passwordLog=$_POST['passwordLogin'];
  if(empty($emailLog) || empty($passwordLog)) echo '<p>wypełnij dane</p>';else{
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
	echo 'Błędne hasło';
    
	}else echo '<p>Błędny e-mail</p>';
 }}
?>
 <button> <a href="register.php">Nie masz konta? Stwórz je</a></button></div>
</form>
</div>
</body>
</html>