<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleHeader.css">


</head>

<body style="background-color: #fff;">

    <?php
    include ("classes/user.php");
include ("classes/posts.php");
require 'require/config.php';
if(isset($_SESSION['email']))
{
$userLoggedIn=$_SESSION['email']; 
$userDetails=mysqli_query($conn, "SELECT * FROM users WHERE email='$userLoggedIn'");
$user = mysqli_fetch_array($userDetails);

}
else header("Location: login.php");

?>
    <?php
if(isset($_GET['post_id']))
{
    $postId=$_GET['post_id'];
}
$userLiked=$user['username'];


$likes=mysqli_query($conn, "Select likes, author from posts where id='$postId'");
$row=mysqli_fetch_array($likes);
$totalLikes=$row['likes'];


$userDetails=mysqli_query($conn, "Select * from users where username='$userLiked'");
$row=mysqli_fetch_array($userDetails);
$totalUserLikes=$row['likes'];


if(isset($_POST['LikeButton']))
{
    $totalLikes++;
    $query=mysqli_query($conn, "UPDATE posts set likes='$totalLikes' where id='$postId'");
    $totalUserLikes++;
    $userLikes=mysqli_query($conn, "UPDATE users set likes='$totalUserLikes' where username='$userLiked'");
    $likesInsert=mysqli_query($conn, "Insert into likes values('', '$userLiked', '$postId')");
}

if(isset($_POST['unLikeButton']))
{
    $totalLikes--;
    $query=mysqli_query($conn, "UPDATE posts set likes='$totalLikes' where id='$postId'");
    $totalUserLikes--;
    $userLikes=mysqli_query($conn, "UPDATE users set likes='$totalUserLikes' where username='$userLiked'");
    $likesInsert=mysqli_query($conn, "Delete from likes where username='$userLiked' and post_id='$postId'");
}



$checkLikes=mysqli_query($conn, "Select * from likes where username='$userLiked' and post_id='$postId'");
if(mysqli_num_rows($checkLikes)>0)
{
    
    echo '<form action="likes.php?post_id='.$postId.'" method="POST">
    <input type="submit" class="comment_like" class="likeBtn" name="unLikeButton" value="nie lubie tego" style="
  border: none;
  position: relative;
  border-radius: 5px;
  width:100px;
  height: 20px;
  font-size:14px;
">
    <div class="like_value">
    '.$totalLikes.' Polubienia
    </div>
    </form>
    ';
}
else 
{
     echo '<form action="likes.php?post_id='.$postId.'" method="POST">
    <input type="submit" class="comment_like" class="likeBtn" name="LikeButton" value="lubie to" style="
  border: none;
  position: relative;
  border-radius: 5px;
  height: 20px;
  width:80px;
  font-size:14px;
">
    <div class="like_value">
    '.$totalLikes.' Polubienia
    </div>
    </form>
    ';
}

?>

</body>

</html>