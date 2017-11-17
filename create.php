<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create profile</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <header>
            <h1 class="title">Create Profile</h1>
            <ul class='nav'>
                <li><a href="index.php">Home</a></li>
                <li><a href="myprofile.php">My Profile</a></li>
                <li><a href="inbox.php">Inbox</a></li>
                <li><a href="create.php">Create Profile</a></li>
                <li><a href="gifts.php">My gifts</a></li>
            </ul>
        </header> 
        <?php
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
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }  
         ?>
        <h3 class="subtitle">Fill up the form and create your profile!</h3>
        <div class="form">
            <form action="action.php" method="POST" enctype="multipart/form-data">
                Name:<br>
                <input id="name" type="text" name="name" maxlength="64" >
                <br><br>
                Age:<br>
                <input id="age" type="text" name="age" maxlength="4">
                <br><br>
                Gender:<br>
                <input id="gender" type="text" name="gender" maxlength="8">
                <br><br>
                Super Power:<br>
                <input id="super_power" type="text" name="super_power" maxlength="20">
                <br><br>
                About me:<br>
                <input id="description" type="text" name="description">
                <br><br>
                Image:<br>
                <input id="image" type="file" name="image">
                <br><br>
                <input type="submit" value="Create">
            </form> 
        </div>
    </body>
</html>
