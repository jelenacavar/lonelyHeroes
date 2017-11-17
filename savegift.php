<?php
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$gift = $_POST['gift'];
$userId= $_POST['user_id'];
$giftedUserId = $_POST['gifted_user_id'];
if(!empty($gift) && !empty($userId) && !empty($giftedUserId))
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
            $stmt = $conn->prepare("INSERT INTO gift (user_id, gift, gifted_user_id) VALUES (:user_id, :gift, :gifted_user_id)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':gift', $gift); 
            $stmt->bindParam(':gifted_user_id', $giftedUserId);            
            $stmt->execute();
            $_SESSION["message"] = sprintf("The gift was send");
            $location = sprintf("Location: sendgift.php?user_id=%s", $giftedUserId);
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

