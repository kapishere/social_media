  <?php
include ("include/header.php");

?>

  <div>
      <p>Zaproszenia do znajomych</p>
      <?php

$userLoggedIn=$user['username'];
$query = mysqli_query($conn, "SELECT * FROM friends_requests WHERE user_to='$userLoggedIn'");
	if(mysqli_num_rows($query) == 0)
		echo "Nie masz zaproszeń do grona znajomych!";
	else {

		while($row = mysqli_fetch_array($query)) {
			$user_from = $row['user_from'];
			$user_from_obj = new User($conn, $user_from);

			echo $user_from_obj->getNames() . " wysłał ci zaproszenie do grona znajomych";

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
          <input type="submit" name="accept_request<?php echo $user_from; ?>" value="Potwierdź">
          <input type="submit" name="ignore_request<?php echo $user_from; ?>" value="Usuń">
      </form>
      <?php
     
    }
}
?>



  </div>