<?php
class User{
    private $user;
    private $conn;
    public function __construct($conn, $user)
    {
        $this->conn=$conn;
$userDetails=mysqli_query($conn, "Select * from users where username='$user'");
$this->user=mysqli_fetch_array($userDetails);
    }
public function getNames()
{
    $user=$this->user['username'];
    $query=mysqli_query($this->conn, "Select name, last_name from users where username='$user'");
    $row=mysqli_fetch_array($query);
    return $row['name']."".$row['last_name'];
}
public function getUsername()
{
    return $this->user['username'];
    
    
}
public function getPosts()
{
   $user=$this->user['username'];
    $query=mysqli_query($this->conn, "Select posts from users where username='$user'");
    $row=mysqli_fetch_array($query);
    return $row['posts'];
}
}