<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$messagedUserId = isset($_GET['user_id'])? $_GET['user_id'] : null;
$users = array();
if(!$messagedUserId)
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
    $stmt->bindParam(':user_id', $messagedUserId);
    $stmt->execute();
    $users = $stmt->fetchAll();  
    // set the resulting array to associative
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
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
            </ul>
        </header>   
        <h2 class='subtitle'>Send Message to: <?php echo $users[0]['name'] ?></h2>
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
            <form class="form" method="POST" action="savemessage.php">
                <textarea name="content" placeholder="Write something" rows="8"></textarea>
                <input type="hidden" name="user_id" value="<?php echo $userId ?>">
                <input type="hidden" name="messaged_user_id" value="<?php echo $messagedUserId ?>">
                <br>
                <button type="submit">Send</button>
            </form>
        </div>                            
            
</body>
</html>
