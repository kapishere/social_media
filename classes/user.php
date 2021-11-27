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
    return $row['name']." ".$row['last_name'];
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

	public function isFriend($username_to_check) {
		$usernameCheck = "," . $username_to_check . ",";

		if((strstr($this->user['friendArr'], $usernameCheck) || $username_to_check == $this->user['username'])) {
			return true;
		}
		else {
			return false;
		}
	}

    public function sentRequest($username_to_check)
    {
        $userFrom=$this->user['username'];
        $query=mysqli_query($this->conn, "Select * from friends_requests where user_to='$username_to_check' and user_from='$userFrom'");
        if(mysqli_num_rows($query)>0)
        {
            return true;
        }else return false;
        
    }
      public function receivedRequest($username_from_check)
    {
        $userTo=$this->user['username'];
        $query=mysqli_query($this->conn, "Select * from friends_requests where user_to='$userTo' and user_from='$username_from_check'");
        if(mysqli_num_rows($query)>0)
        {
            return true;
        }else return false;
        
    }

    public function removeFriend($user_to_remove)
    {
        $LoggedUser=$this->user['username'];
        $query=mysqli_query($this->conn, "Select friendArr from users where username='$user_to_remove'");
        $row=mysqli_fetch_array($query);
        $friend_array_username=$row['friendArr'];
        $newFriend=str_replace($user_to_remove.',', '', $this->user['friendArr']);
        $removeFriend=mysqli_query($this->conn, "Update users set friendArr='$newFriend' where username='$LoggedUser'");

        $newFriend=str_replace($this->user['username'].',', '', $friend_array_username);
        $removeFriend=mysqli_query($this->conn, "Update users set friendArr='$newFriend' where username='$user_to_remove'");


        
    }

     public function addFriend($user_to_add)
    {
        $LoggedUser=$this->user['username'];
        $query=mysqli_query($this->conn, "Insert into friends_requests values('', '$user_to_add', '$LoggedUser')");
      
    }
    public function getFriends()
{
   $user=$this->user['username'];
    $query=mysqli_query($this->conn, "Select friendArr from users where username='$user'");
    $row=mysqli_fetch_array($query);
    return $row['friendArr'];
}

    

}