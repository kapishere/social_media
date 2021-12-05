    <?php
include ("include/header.php");


$userLoggedIn=$user['username'];
	$friendsNum = (substr_count($user['friendArr'], ",")) - 1;
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
        <div class="request">
            <div class="wall column">
                <a href="<?php echo $user['username']?>" id="names">
                    <a href="<?php echo $user['username']?>" id="names">
                        <img width='60px' src='<?php  echo "data:image/png;base64,". $user['picture']?>'>

                    </a>
                </a>
                <a href="<?php echo $user['username']?>" id="names">
                    <?php echo $user['name'].' '.$user['last_name']; ?></a>
                <br>
                <?php
            echo '<br>Polubienia: '.$user['likes'];
            echo '<br>Posty: '.$user['posts'];
            echo '<br>Znajomi '.$friendsNum 
            ?>

                <br><br><br>
                <form class="form-wall" action="index.php" method="POST">
                    <textarea name="post_text" placeholder="Jak leci?"></textarea><br>
                    <input type="submit" class="publishBtn" name="publish" value="Opublikuj">
                </form>


                <?php
$post=new Posts($conn, $user['username']);
$post->loadPosts();
            ?>

            </div>

        </div>


    </body>


    </html>