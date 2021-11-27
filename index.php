    <?php
include ("include/header.php");


$userLoggedIn=$user['username'];

if(isset($_POST['publish']))
{
$post=new Posts($conn, $user['username']);
$post->submitPosts($_POST['post_text'], '');
header("Location: index.php");


}
?>
    <!DOCTYPE html>
    <html lang="pl">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Social Media</title>
    </head>

    <body>
        <div class="user-details column">
            > <a href="<?php echo $user['username']?>">
                <?php echo $user['name'].' '.$user['last_name']; ?></a>
            <?php
            echo '<br>Polubienia '.$user['likes'];
            echo '<br>Posty '.$user['posts'];
            ?>
        </div>
        <div class="wall column">
            <form class="form-wall" action="index.php" method="POST">
                <textarea name="post_text" placeholder="Jak leci?"></textarea>
                <input type="submit" name="publish" value="Opublikuj">
            </form>


            <?php
// $user_obj=new User($conn, $user['username']);
// echo $user_obj->getUsername();

$post=new Posts($conn, $user['username']);
$post->loadPosts();



            ?>
        </div>

        </div>


    </body>


    </html>