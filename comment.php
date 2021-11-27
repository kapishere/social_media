<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styleHeader.css?<?php echo time(); ?>">
</head>

<body>
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


    <script>
    function toogle() {
        var element = document.getElementById("comment_section");

        if (element.style.display === "block") {
            element.style.display = "none";
        } else {
            element.style.display = "block";

        }
    }
    </script>
    <?php
if(isset($_GET['post_id']))
{
    $postId=$_GET['post_id'];
}


$query=mysqli_query($conn, "SELECT author, receiver from posts where id='$postId'");
$row=mysqli_fetch_array($query);
$author=$row['author'];


if(isset($_POST['postComment'. $postId]))
{
$usernameComment=$user['username'];
    $post_body=$_POST['body'];
$date_time_now=date("Y-m-d H:i:s");
$insert=mysqli_query($conn, "INSERT INTO comments VALUES('', '$post_body', '$usernameComment', '', '$date_time_now',  '$postId' )");
}

    ?>
    <form action="comment.php?post_id=<?php echo $postId?>" id="comment_form" name="postComment<?php echo $postId?>"
        method="POST">
        <textarea name="body"></textarea>
        <br>
        <input type="submit" name="postComment<?php echo $postId?>">

    </form>
    <?php
$getComments=mysqli_query($conn, "Select * from comments where post_id='$postId' order by id desc");
$countComments=mysqli_num_rows($getComments);
if($countComments!=0)
{
    while($comment=mysqli_fetch_array($getComments))
    {
$commentBody=$comment['body'];
$receiver=$comment['receiver'];
$author=$comment['author'];
$dateAdded=$comment['date'];


$dateNow=date("Y-m-d H:i:s");
$starDate= new DateTime($dateAdded);
$end_date=new DateTime($dateNow);
$interval=$starDate->diff($end_date);

if($interval->y >= 1) {
						if($interval === 1)
							$time_message = $interval->y . " rok temu";
						else 
							$time_message = $interval->y . " lata temu"; 
					}
					else if ($interval-> m >= 1) {
					
						if($interval->m === 1) {
							$time_message = $interval->m . " miesiąc temu";
						}
						else {
							$time_message = $interval->m . " miesięcy temu";
						}

					}
					else if($interval->d >= 1) {
						if($interval->d === 1) {
							$time_message = " wczoraj";
						}
						else {
							$time_message = $interval->d . " dnii temu";
						}
					}
					else if($interval->h >= 1) {
						if($interval->h ===1) {
							$time_message = $interval->h . " godzine temu";
						}
						else {
							$time_message = $interval->h . " godzin temu";
						}
					}
					else if($interval->i >= 1) {
						if($interval->i === 1) {
							$time_message = $interval->i . " minute temu";
						}
						else {
							$time_message = $interval->i . " minut temu";
						}
					}
					else {
						if($interval->s < 60) {
							$time_message = "W tym momencie";
						}
						
					}


$userObject=new User($conn, $author);

?>
    <div class="comment_section">
        <br>
        <a href="<?php echo $author?>" target='_parent'><?php  echo $author; ?></a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $time_message."<br>".$commentBody; ?>
        <hr>
    </div>
    <?php
    }
}
else echo "<center><br>No comments</center>"

?>

</body>

</html>