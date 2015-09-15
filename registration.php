<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once('functions.php');
$userID = getUserId();
$error   = ''; // Variable To Store Error Message
$errors  = ''; // Variable To Store Error Message
$errorss = '';



if (isset($_POST['signup'])) {
    
    
    
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {
        
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        if (strlen($username) > 10) {
            $errorss = 'Username is longer than 10 chars';
        } else {
            
            $connection = mysqli_connect("localhost", "root", "root", "company");
            
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            $result2 = mysqli_query($connection, "SELECT * FROM login WHERE  '$username' = username");
            
            $num_rows = mysqli_num_rows($result2);
            
            if ($num_rows == 0) {
                //Create new user
                $sql = "INSERT INTO login (username, password) VALUES 
                ('$username' , '$password')";
                
                if (mysqli_query($connection, $sql)) {
                    
                    echo "New record created successfully!";
                    
                } else {
                    
                    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                }
                
            } else {
                
                $errors = "Username is already taken!";
            }
           $sql = "SELECT id FROM login WHERE ('$username' = username)";
            if (mysqli_query($connection, $sql)) {
        
                $cursor = mysqli_query($connection, $sql);
                $row    = mysqli_fetch_row($cursor);
                $useridd = $row[0];
             
                $sqlz = "INSERT INTO Follows (user_id, followee_id) VALUES ('$useridd', '$useridd')";
                if(mysqli_query($connection, $sqlz)){
                echo "New record created successfully!";
            }
               else {
                    
                    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                } 
            }
                 
                           
            
            
            
            }
       

            
        }
    }

?>