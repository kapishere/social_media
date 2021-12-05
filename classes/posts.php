<?php

class Posts{
    private $objectUser;
    private $conn;

    public function __construct($conn, $objectUser)
    {
        $this->conn=$conn;
$this->objectUser=new User($conn, $objectUser);
    }
public function submitPosts($body, $receiver)
{


$date_added=date("Y-m-d H:i:s");
$author=$this->objectUser->getUsername();

if($receiver===$author)
{
    $receiver='';
}
$query=mysqli_query($this->conn, "INSERT INTO posts values('', '$body', '$author', '$receiver', '$date_added', '')");
$returned_id=mysqli_insert_id($this->conn);

$posts=$this->objectUser->getPosts();
$posts++;
$updatePosts=mysqli_query($this->conn, "Update users SET posts='$posts' where username='$author'");
    
}

public function showPosts($data)
{
    $string='';
    
  while($row=mysqli_fetch_array($data))
    {
        $id=$row['id'];
        $body=$row['body'];
        $author=$row['author'];
        $date=$row['date'];
        $receiver=$row['receiver'];
   

        if($row['receiver']!=='')
        {
            $objectUser=new User($this->conn, $row['receiver']);
			$receiverPic=$objectUser->getPicture();
            $receiver="do <a href='".$row['receiver']."'> <img height='25px' src='data:image/png;base64,$receiverPic'> ".$receiver."</a>";
        }
        

?>
<script>
function toggle<?php echo $id?>() {
    var target = $(event.target);
    if (!target.is('a')) {
        var element = document.getElementById("toggleComment<?php echo $id;?>");

        if (element.style.display === "block") {
            element.style.display = "none";
        } else {
            element.style.display = "block";

        }
    }


}
</script>

<?php
$commentsNum=mysqli_query($this->conn, "SELECT * FROM comments where post_id='$id'");
$commentsNumber=mysqli_num_rows($commentsNum);


$dateNow=date("Y-m-d H:i:s");
$starDate= new DateTime($date);
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
							$time_message = $interval->d . " dni temu";
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
					$userObject=new User($this->conn, $author);
$authorPic=$userObject->getPicture();

$string.="<div class='status-posts' onClick='toggle$id()'>
<div class='author-name'>
<a href='$author'><img height='35px'  src='data:image/png;base64,$authorPic'> $author </a><h3 style='display: inline-block;'> $receiver </h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h4 style='display: inline-block;'> $time_message</h4>  <br><br>
</div>
<div class='post-body'>$body<br></div><br>
</div>
<div class='newsFeed' onClick='toggle$id()'>
Komentarzy($commentsNumber)&nbsp&nbsp&nbsp

</div>
<div class='post_comment' id='toggleComment$id' style='display:none;'>
<iframe src='comment.php?post_id=$id' frameborder='0' id='comment_iframe'></iframe>
</div>
<iframe src='likes.php?post_id=$id' scrolling='no' class='likesIframe' frameborder='0'  
    height='4%'></iframe>
<hr>
";

}
echo $string;
}


public function loadPosts()
{
    $data=mysqli_query($this->conn, "Select * from posts  order by date desc Limit 15");
  Posts::showPosts($data);
}

public function loadProfilePosts($profile)
{
    $data=mysqli_query($this->conn, "Select * from posts where author='$profile' or receiver='$profile' order by date desc limit 15");
  Posts::showPosts($data);

}

}