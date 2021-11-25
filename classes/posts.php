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

if($receiver=$author)
{
    $receiver='';
}
$query=mysqli_query($this->conn, "INSERT INTO posts values('', '$body', '$author', '$receiver', '$date_added', '')");
$returned_id=mysqli_insert_id($this->conn);

$posts=$this->objectUser->getPosts();
$posts++;
$updatePosts=mysqli_query($this->conn, "Update users SET posts='$posts' where username='$author'");
    
}
}