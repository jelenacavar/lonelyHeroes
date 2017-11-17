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
                <li><a href="gifts.php">My gifts</a></li>
            </ul>
        </header>   
        <h2 class='subtitle'>Welcome to the world of lonely heroes!</h2>      
        <?php
         session_start();
         $userId = 1; //I'm logged as IronMan
        //connection with PDO to database        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $result = array();
        $likes = array();
        $receivedcomments = array();
        try 
        {
            //SETUP connection
            $conn = new PDO("mysql:host=$servername;dbname=lonely_heroes", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM user WHERE user_id != :user_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll(); 
            $stmt = $conn->prepare("SELECT user.name, main_table.content, main_table.commented_user_id FROM comment as main_table LEFT JOIN user ON main_table.user_id = user.user_id WHERE main_table.user_id=:user_id GROUP BY main_table.comment_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            $receivedcomments = $stmt->fetchAll();
            // set the resulting array to associative
             $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                 
            $stmt = $conn->prepare("SELECT * FROM like_it");
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $likes = $stmt->fetchAll();   
            //var_dump($result);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }  
         ?>
        <?php foreach($result as $user): ?>
        <div class="superhero">
            <img class='user_img' src="<?php echo $user['image'];?>" alt="<?php echo $user['name'] ?>"> 
            <br>
                    <?php
                            $count = 0;
                            foreach($likes as $like)
                            {
                                if($like['liked_user_id'] == $user['user_id'])
                                {
                                    $count++;
                                }
                            }
                        ?>
            <img class='icon' alt='like' src="icons/like.png" onclick="like(<?php echo $user['user_id'] ?>)">               
            <span id="count_<?php echo $user['user_id'] ?>">
                    <?php echo $count; ?>
            </span>
            <a href='sendmessage.php?user_id=<?php echo $user['user_id'] ?>'><img class='icon' alt='message' src="icons/message.png"></a>
            <a href="sendgift.php?user_id=<?php echo $user['user_id'] ?>"><img class='icon' alt='gift' src="icons/gift.png"></a>
            <br>
            <h3 class='name'>Name: <?php echo $user['name'];?></h3>
            <p class='description'>Age: <?php echo $user['age'];?></p>
            <p class='description'>Super Power: <?php echo $user['super_power'];?></p>
            <p class='description'>Gender: <?php echo $user['gender'];?></p>
            <p class='description'>About me: <?php echo $user['description'];?></p> 
            <br>
            <div>
            <?php foreach($receivedcomments as $comment): ?>
                <div class="form" id="comment_user_<?php echo $user['user_id'] ?>">
                <?php if($comment['commented_user_id'] == $user['user_id']): ?>
                    <p><strong><?php echo $comment['name'] ?></strong><br><?php echo $comment['content'];?></p>                                
                <?php endif; ?>
                </div>
            <?php endforeach; ?>    
            </div> 
            <div class="comment-container">            
                <form class="form" method="POST" action="savecomment.php">
                    <textarea name="content" placeholder="Write your comment" rows="8"></textarea>
                    <input type="hidden" name="commented_user_id" value="<?php echo $user['user_id'] ?>">
                    <input type="hidden" name="user_id" value="<?php echo $userId ?>">
                    <br>
                    <button type="submit">Comment</button>
                </form>
            </div>             
        </div>
        <?php endforeach; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            function like(userId)
            {
                jQuery.post({
                    url: 'like.php',
                    data: {liked_user_id : userId},
                    success: function(){
                        var count = jQuery("#count_"+userId);
                        var value = parseInt(count.html());
                        
                        count.html(value + 1);
                    }
                });
            }
        </script>
    </body>
</html>
