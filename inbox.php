<?php 
$userId = 1; //I'm logged as IronMan
$servername = "localhost";
$username = "root";
$password = "";
$sentMessages = array();
$receivedMessages = array();
try 
{
    //SETUP connection
    $conn = new PDO("mysql:host=$servername;dbname=lonely_heroes", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT user.name, main_table.content FROM message as main_table LEFT JOIN user ON main_table.messaged_user_id = user.user_id WHERE main_table.user_id=:user_id GROUP BY main_table.message_id");
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $sentMessages = $stmt->fetchAll();
        
    $stmt = $conn->prepare("SELECT user.name, main_table.content FROM message as main_table LEFT JOIN user ON main_table.user_id = user.user_id WHERE main_table.messaged_user_id=:messaged_user_id GROUP BY main_table.message_id");
    $stmt->bindParam(':messaged_user_id', $userId);
    $stmt->execute();
    $receivedMessages = $stmt->fetchAll();
    // set the resulting array to associative
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}  
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inbox</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <header>
            <h1 class="title">Inbox-Iron Man</h1>
            <ul class='nav'>
                <li><a href="index.php">Home</a></li>
                <li><a href="myprofile.php">My Profile</a></li>
                <li><a href="inbox.php">Inbox</a></li>
                <li><a href="create.php">Create Profile</a></li>
                <li><a href="gifts.php">My gifts</a></li>
            </ul>
        </header>
        <div class="messages">
            <h1>Sent messages:</h1>
            <?php foreach($sentMessages as $message): ?>
            <div class="message">
                <p><strong>Sent to: <?php echo $message['name'] ?></strong></p>
                <p><strong>Message:</strong><br><?php echo $message['content'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="messages">
            <h1>Received messages:</h1>
            <?php foreach($receivedMessages as $message): ?>
            <div class="message">
                <p><strong>Sent By: <?php echo $message['name'] ?></strong></p>
                <p><strong>Message:</strong><br><?php echo $message['content'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>        
    </body>
</html>