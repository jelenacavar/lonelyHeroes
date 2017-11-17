<?php 
$userId = 1; //I'm logged as IronMan
$servername = "localhost";
$username = "root";
$password = "";
$receivedgifts = array();
try 
{
    //SETUP connection
    $conn = new PDO("mysql:host=$servername;dbname=lonely_heroes", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    $stmt = $conn->prepare("SELECT user.name, main_table.gift FROM gift as main_table LEFT JOIN user ON main_table.user_id = user.user_id WHERE main_table.gifted_user_id=:gifted_user_id GROUP BY main_table.gift_id");
    $stmt->bindParam(':gifted_user_id', $userId);
    $stmt->execute();
    $receivedgifts = $stmt->fetchAll();
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
        <title>Gifts</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <header>
            <h1 class="title">My Gifts</h1>
            <ul class='nav'>
                <li><a href="index.php">Home</a></li>
                <li><a href="myprofile.php">My Profile</a></li>
                <li><a href="inbox.php">Inbox</a></li>
                <li><a href="create.php">Create Profile</a></li>
                <li><a href="gifts.php">My Gifts</a></li>
            </ul>
        </header>
        <div>
            <h1 class="my_gift">My Gifts</h1>
            <?php foreach($receivedgifts as $gift): ?>
            <div class="form">
                <p><strong>From: <?php echo $gift['name'] ?></strong></p>                
                <p><strong>Gift:</strong><br><img class='gift' src="<?php echo $gift['gift'];?>" alt="<?php echo $gift['gift'] ?>"></p> 
            </div>
            <?php endforeach; ?>       
        </div>        
    </body>
</html>