<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$content = strip_tags($_POST['content']);
$userId= $_POST['user_id'];
$commentedUserId= $_POST['commented_user_id'];
if(!empty($content)&& !empty($userId) && !empty($commentedUserId))
{
        //connection with PDO to database        
        $servername = "localhost";
        $username = "root";
        $password = "";

        try 
        {            
            //SETUP connection
            $conn = new PDO("mysql:host=$servername;dbname=lonely_heroes", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT INTO comment (user_id, content, commented_user_id) VALUES (:user_id, :content, :commented_user_id)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':commented_user_id', $commentedUserId);
            $stmt->execute();            
            $location = sprintf("Location: index.php#comment_user_%s", $commentedUserId);
            header($location);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }  
}
else
{
    die('Please set all the fields!');
}

