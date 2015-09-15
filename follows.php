<?php
/*
ini_set('display_errors',1); 
error_reporting(E_ALL);
include('session.php');

if(!isset($_SESSION)) { 
    session_start(); 
     echo $login_session;
}
else{
  session_start();
  echo $login_session;  
  $username = $login_session;
  echo $username;
}*/
?>
<?php



function showPublic()
{
    $conn = mysqli_connect("localhost", "root", "root", "company");
    
    $sqli     = "SELECT username FROM login LIMIT 0,10";
    $result   = mysqli_query($conn, $sqli);
    $profiles = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            // echo "author: " . $row["poster"] . " -text: " . $row["text"] . "<br>";
            array_push($profiles, $row);
            
        }
        
    }
    return $profiles;
}
/*
function follow($params){
$user = $login_session;
$this->follows($user, $params[0]));


}
*/
function getFollowersRibbits($userID)
{
    
     $conn = mysqli_connect("localhost", "root", "root", "company");  
    
  $sql =  "SELECT username, text, created_at FROM posts JOIN (SELECT * FROM login LEFT JOIN (SELECT followee_id FROM Follows WHERE user_id = $userID) AS Follows ON followee_id = poster_id WHERE followee_id = poster_id OR poster_id = $userID) AS login on user_id = login.id ORDER BY created_at";
  $res = mysqli_query($conn, $sql);
  $fribbits = array();
  if(mysqli_num_rows($res)> 0){
        while($row = mysqli_fetch_array($res)){
  
    array_push($fribbits, $row);
  
      
  }

}
     return $fribbits;
}













function follows($uid, $followeeID)
{
 
    // userID är login_session och followeeID
    // blir ID't till den personen vars follow knapp
    // som trycks
    $conn = mysqli_connect("localhost", "root", "root", "company");
  
  

    
   
    $sql = "INSERT INTO Follows (user_id, followee_id) VALUES ('$uid', '$followeeID')";  
            if (mysqli_query($conn, $sql)) {
           

        }
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  
    }  

function unfollows($uid, $followeeID){

   $conn = mysqli_connect("localhost", "root", "root", "company");
    
    $sql = "DELETE FROM Follows WHERE (('$uid' = user_id) AND ('$followeeID' = followee_id))";
      if (mysqli_query($conn, $sql)) {
           

        }
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
}
    



function getOtherUserID($username)
{
   $conn = mysqli_connect("localhost", "root", "root", "company");
    
    $sql = "SELECT id FROM login WHERE ('$username' = username)";
    if (mysqli_query($conn, $sql)) {
        
        $cursor = mysqli_query($conn, $sql);
        $row    = mysqli_fetch_row($cursor);
        $userID = $row[0];
        return $userID;
    }
      
}

function isfollowstrue($followerarray, $followeeid){
    
    //$conn = mysqli_connect("localhost", "root", "root", "company");
  //echo "<br /> <br /> id: ".$followeeid."<br />";
  //  var_dump($followerarray);
    foreach($followerarray as $value){
    //  echo "value: ".$value['followee_id']."<br />";
        if($followeeid == $value['followee_id']){
      //      echo "true";
            return true;
            
        } else{
        //    echo "false";
            return false;
        }
        
    }
    //echo "<hr />";
}
  

function getFollowersByID($userid)
{
     $conn = mysqli_connect("localhost", "root", "root", "company");
    
    $sql = "SELECT followee_id FROM Follows WHERE ('$userid' = user_id)";
    $result   = mysqli_query($conn, $sql);
    $profiles = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            // echo "author: " . $row["poster"] . " -text: " . $row["text"] . "<br>";
            array_push($profiles, $row['followee_id']);
            
        }
        
    }
    return $profiles;
    
    
    
}
function getFollowersByIDD($userid)
{
     $conn = mysqli_connect("localhost", "root", "root", "company");
    
    $sql = "SELECT followee_id FROM Follows WHERE ('$userid' = user_id)";
    $result   = mysqli_query($conn, $sql);
    $profiles = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            // echo "author: " . $row["poster"] . " -text: " . $row["text"] . "<br>";
            array_push($profiles, $row);
            
        }
        
    }
    return $profiles;
    
    
    
}

  






?>




