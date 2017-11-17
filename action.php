<?php
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$name = $_POST['name'];
$userId = $_POST['user_id'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$super_power= $_POST['super_power'];
$description = $_POST['description'];
$image = $_FILES['image'];
$isNewImage = $image['error'] == 0;
$image = $isNewImage? $image : $_POST['image'];
if(!empty($name) && !empty($age) && !empty($gender) && !empty($super_power) && !empty($description) && !empty($image))
{
        $age = filter_var($age, FILTER_VALIDATE_INT);
            
        if(!$age)
        {
            echo 'The age is not valid';
            return;
        }           
            
        //connection with PDO to database        
        $servername = "localhost";
        $username = "root";
        $password = "";
            
        try 
        {
            $imagePath = "";
            if($isNewImage)
            {                
                $imagePath = "image/".$image['name'];
                if(!move_uploaded_file($image['tmp_name'], $imagePath))
                {
                    die('Error uploading file - check destination is writeable.');
                }
                    
            }
            else{
                $imagePath = $image;
            }
            //SETUP connection
            $conn = new PDO("mysql:host=$servername;dbname=lonely_heroes", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if(isset($userId))
            {                
                $stmt = $conn->prepare("UPDATE user SET name=:name, age=:age, gender=:gender, super_power=:super_power, description=:description, image=:image WHERE user_id=:user_id");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':age', $age); 
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':super_power',$super_power); 
                $stmt->bindParam(':description',$description);
                $stmt->bindParam(':image', $imagePath);
                $stmt->bindParam(':user_id', $userId);
                $stmt->execute();
                $_SESSION["message"] = sprintf("The profile %s was saved", $name);
                header('Location: myprofile.php'); 
            }
            else
            {
                $stmt = $conn->prepare("INSERT INTO user (name, age, gender, super_power, description, image) VALUES (:name, :age, :gender, :super_power, :description, :image)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':age', $age); 
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':super_power',$super_power); 
                $stmt->bindParam(':description',$description);
                $stmt->bindParam(':image', $imagePath);
                $stmt->execute();
                $_SESSION["message"] = sprintf("The profile %s was saved", $name);
                header('Location: index.php');    
            }
                
                
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
    
    