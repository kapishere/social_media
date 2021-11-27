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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>

</head>
<div class="request">
    <div class="wall column">

        <a href="<?php echo $user['username']?>" id="names">
            <?php echo $user['name'].' '.$user['last_name']; ?></a><br>
        <?php echo '<br>Polubienia '.$userInfo['likes'] ?>
        <?php echo '<br>Posty '.$userInfo['posts'] ?>
        <?php echo '<br>Znajomi '.$friendsNum ?>





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
  ?>







            <br><br>
            <form class="form-wall" action="index.php" method="POST">
                <textarea name="post_text"
                    placeholder="Napisz coś na temat:    <?php echo $user['name'].' '.$user['last_name']; ?>"></textarea>
                <input type="submit" class="publishBtn" name="publish" value="Opublikuj">
            </form>
            <?php
$post=new Posts($conn, $user['username']);
$post->loadProfilePosts($user['username']);

        ?>
        </form>