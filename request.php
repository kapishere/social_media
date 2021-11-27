  <?php
include ("include/header.php");

?>


  <div class="request">
      <div class="wall column">

          <h1>Zaproszenia do znajomych</h1><br><br>
          <?php

$userLoggedIn=$user['username'];
$query = mysqli_query($conn, "SELECT * FROM friends_requests WHERE user_to='$userLoggedIn'");
	if(mysqli_num_rows($query) == 0)
		echo "<h3>Nie masz zaproszeń do grona znajomych!</h3>";
	else {

		while($row = mysqli_fetch_array($query)) {
			$user_from = $row['user_from'];
			$user_from_obj = new User($conn, $user_from);

			echo '<h3>'.$user_from_obj->getNames() . " wysłał ci zaproszenie do grona znajomych</h3>";

			$user_from_friend_array = $user_from_obj->getFriends();

			if(isset($_POST['accept_request' . $user_from ])) {
				$add_friend_query = mysqli_query($conn, "UPDATE users SET friendArr=CONCAT(friendArr, '$user_from,') WHERE username='$userLoggedIn'");
				$add_friend_query = mysqli_query($conn, "UPDATE users SET friendArr=CONCAT(friendArr, '$userLoggedIn,') WHERE username='$user_from'");

				$delete_query = mysqli_query($conn, "DELETE FROM friends_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
				echo "Zaproszenie zaakceptowane!";
				header("Location: request.php");
			}

			if(isset($_POST['ignore_request' . $user_from ])) {
				$delete_query = mysqli_query($conn, "DELETE FROM friends_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
				echo "Usunięto zaproszenie";
				header("Location: request.php");
			}
?>
          <form action="request.php" method="POST">
              <input type="submit" class="addBtn" name="accept_request<?php echo $user_from; ?>" value="Potwierdź">
              <input type="submit" class="addBtn" name="ignore_request<?php echo $user_from; ?>" value="Usuń">
              <hr>
          </form>
          <?php
     
    }
}
?>



      </div>