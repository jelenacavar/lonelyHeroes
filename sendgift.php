<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$giftedUserId = isset($_GET['user_id'])? $_GET['user_id'] : null;
$users = array();
if(!$giftedUserId)
{
    die('No user defined.!');
}
$userId = 1; //I'm logged as IronMan
$servername = "localhost";
$username = "root";
$password = "";
$users = array();
try 
{
    //SETUP connection
    $conn = new PDO("mysql:host=$servername;dbname=lonely_heroes", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_id=:user_id");
    $stmt->bindParam(':user_id', $giftedUserId);
    // set the resulting array to associative
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $stmt->execute();
    $users = $stmt->fetchAll();  
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}  
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lonely Heroes</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <header>
            <h1 class="title">Lonely Heroes</h1>
            <ul class='nav'>
                <li><a href="index.php">Home</a></li>
                <li><a href="myprofile.php">My Profile</a></li>
                <li><a href="inbox.php">Inbox</a></li>
                <li><a href="create.php">Create Profile</a></li>
                <li><a href="gifts.php">Gifts</a></li>
            </ul>
        </header>   
        <h2 class='subtitle'>Send Gift to: <?php echo $users[0]['name'] ?></h2>
        <h2 class="subtitle">
            <?php 
            $message = $_SESSION['message'];
            if($message)
            {
                echo $message;
            }
            $_SESSION['message'] = null;
            ?>
        </h3>
        <div class="message-container">            
            <form class="form" method="POST" action="savegift.php">
                <img class="gift" src="gifts/gun.png" alt="gun"/><input class="gift-choice" name="radio" type="radio" value="gifts/gun.png" checked>
                <img class="gift" src="gifts/sword.jpg" alt="sword"/><input class="gift-choice" name="radio" type="radio" value="gifts/sword.jpg">
                <img class="gift" src="gifts/shield.jpg" alt="shield"/><input class="gift-choice" name="radio" type="radio" value="gifts/shield.jpg">
                <input id="gift" type="hidden" name="gift" value="gifts/gun.png">
                <input type="hidden" name="user_id" value="<?php echo $userId ?>">
                <input type="hidden" name="gifted_user_id" value="<?php echo $giftedUserId ?>">
                <br>
                <button type="submit">Send</button>
            </form>
        </div>                            
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            jQuery(".gift-choice").click(function(){
                console.log('click');
                jQuery("#gift").val(jQuery(this).val());
            });
        </script>
</body>
</html>
