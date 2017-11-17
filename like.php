<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$likedUserId= $_POST['liked_user_id'];
$userId = 1; //login as Ironman
if(!empty($likedUserId))
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
            $stmt = $conn->prepare("INSERT INTO like_it (user_id, liked_user_id) VALUES (:user_id, :liked_user_id)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':liked_user_id', $likedUserId);                      
            $stmt->execute();
            echo "success";
        }
        catch(PDOException $e)
        {
            echo "error";
        }  
}
else
{
    echo "error";
}

