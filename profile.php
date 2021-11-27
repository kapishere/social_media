    <?php
include ("include/header.php");


if(isset($_GET['profile_username']))
{
    $username=$_GET['profile_username'];
    $userDetails=mysqli_query($conn, "Select * from users where username='$username'");
    $userInfo=mysqli_fetch_array($userDetails);
   	$friendsNum = (substr_count($userInfo['friendArr'], ",")) - 1;

}
if(isset($_POST['publish']))
{
$post=new Posts($conn, $user['username']);
$username1=$_GET['profile_username'];
$post->submitPosts($_POST['post_text'], $username1);


}

?>

    <div class="user-details column">
        <?php echo $username; ?>
        <?php echo '<br>Posty '.$userInfo['posts'] ?>
        <?php echo '<br>Polubienia '.$userInfo['likes'] ?>
        <?php echo '<br>Znajomi '.$friendsNum ?>

    </div>
    <div class="profileInfo">
    </div>

    <form action="<?php echo $username;?>" method="POST">
        <?php $userObject=new User($conn, $username) ;
        
        $loggedUser = new User($conn, $user['username']);
      

        if($user['username']!==$username)
        {
if($loggedUser->isFriend($username))
{
 
    echo'<input type="submit" name="removeFriend" value="usuń znajomego">';
}
else if($loggedUser->receivedRequest($username))
{
     echo'<input type="submit" name="request" value="Przyjmij zaproszenie">';
}
else if($loggedUser->sentRequest($username))
{
     echo'<input type="submit" name="" value="Zaproszenie wyslane">';
    
}
else
{
     echo'<input type="submit" name="addFriend" value="dodaj znajomego">';
          


}
        }
if(isset($_POST['removeFriend']))
{


    $user1 = new User($conn, $user['username']);
    $user1->removeFriend($username);
}
if(isset($_POST['addFriend']))
{

    $user2 = new User($conn, $user['username']);
    $user2->addFriend($username);
    
}    
if(isset($_POST['request']))
{
  header("Location: request.php");
}
  ?> <div class="wall column">
            <form class="form-wall" action="index.php" method="POST">
                <textarea name="post_text"
                    placeholder="Napisz coś na temat:  <?php echo $_GET['profile_username']; ?>"></textarea>
                <input type="submit" name="publish" value="Opublikuj">
            </form>
            <?php
$post=new Posts($conn, $user['username']);
$post->loadPosts('$username');

        ?>
    </form>