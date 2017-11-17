<?php
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$content = strip_tags($_POST['content']);
$userId= $_POST['user_id'];
$messagedUserId = $_POST['messaged_user_id'];
if(!empty($content)&& !empty($userId) && !empty($messagedUserId))
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
            $stmt = $conn->prepare("INSERT INTO message (user_id, content, messaged_user_id) VALUES (:user_id, :content, :messaged_user_id)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':content', $content); 
            $stmt->bindParam(':messaged_user_id', $messagedUserId);            
            $stmt->execute();
            $_SESSION["message"] = sprintf("The message was send");
            $location = sprintf("Location: sendmessage.php?user_id=%s", $messagedUserId);
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

