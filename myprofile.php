<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Iron Man</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <header>
            <h1 class="title">Iron Man</h1>
            <ul class='nav'>
                <li><a href="index.php">Home</a></li>
                <li><a href="myprofile.php">My Profile</a></li>
                <li><a href="inbox.php">Inbox</a></li>
                <li><a href="create.php">Create Profile</a></li>
                <li><a href="gifts.php">My gifts</a></li>
            </ul>
        </header> 
                <?php
         session_start();
        //connection with PDO to database        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $result = array();
        try 
        {
            //SETUP connection
            $conn = new PDO("mysql:host=$servername;dbname=lonely_heroes", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM user WHERE user_id=1;"); 
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();    
            //var_dump($result);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }  
         ?>
        <form class="form" action="action.php" method="POST" enctype="multipart/form-data">
        <?php foreach($result as $user): ?>
            <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
            <input type="hidden" name="image" value="<?php echo $user['image'] ?>">
            <img class='user_img' src="<?php echo $user['image'];?>" alt="<?php echo $user['name'] ?>">              
            <label for="name">Name:</label><br>
            <input id="name" type="text" name="name" value="<?php echo $user['name'];?>" maxlength="64">
            <br><br>
            <label for="age">Age:</label><br>
            <input id="age" type="text" name="age" value="<?php echo $user['age'];?>" maxlength="4">
            <br><br>
            <label for="gender">Gender:</label><br>
            <input id="gender" type="text" name="gender" value="<?php echo $user['gender'];?>" maxlength="8">
            <br><br>
            <label for="super_power">Super Power:</label><br>
            <input id="super_power" type="text" name="super_power" value="<?php echo $user['super_power'];?>" maxlength="20">
            <br><br>
            <label for="description">About Me:</label><br>
            <input id="description" type="text" name="description" value="<?php echo $user['description'];?>">
            <br><br>
            <label for="image">Image:</label><br>
            <input id="image" type="file" name="image">
            <br><br>
            <input type="submit" value="Update">
        <?php endforeach; ?>
        </form>        
    </body>
</html>


