<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);
include_once('posts.php');
include_once('functions.php');
include_once('follows.php');
$login_session = getUserName();
$userID = getUserId();
$following = getFollowersByIDD($userID);
$tweetzers = array();


?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Your Home Page</title>

        <link href="assets/bootstrap/css/be.css" rel="stylesheet" type="text/css">
        <link href="assets/css/styles.css" rel="stylesheet" type="text/css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="jquery.charactercounter.js"></script>

        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
  
    </head>

    <body>
        <section class="container">
                <section class="profile-form">
                        <section class="form-outer">
                    <div id="profiles">
            <h2>Welcome  <?php echo $login_session; ?>!</h2>

            <a href="logout.php" class="btn btn-info" role="button">Logout</a>
            <a href="public.php" class="btn btn-info" role="button">Public</a>

            <div class="feed">
                <form action="" method="post" class="forms">
                    <textarea name="comment" rows="6" class="form-control" id="demo"></textarea>
                    <input name="tweettext" type="submit" value="Tweet">

                </form>



              
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4">
                            <div class="twt-wrapper">
                                <div class="panel panel-info">

                                    <div class="panel-body">



                                        <hr />
                                        <?php 
              
                    //$tweetarray = getTweetsByID($userID);
                   
                    foreach($following as $value){
                        
                       $fidarr = getTweetsByID($value['followee_id']);
                    //var_dump($fidarr) $fidarr håller rätt information
                    //när det försökts skrivas över till $tweetzers så hämtar den bara
                    //in för den inloggade användaren    
                        foreach($fidarr as $value){
                            $tweetzers[] = $value;
                        }
                        
              
                      
                       
                    }
                     function sortFunction( $a, $b ) {
                    return strtotime($a["created_at"]) - strtotime($b["created_at"]);
                    }   




                    usort($tweetzers, "sortFunction");
                    $reversed = array_reverse($tweetzers);
                    foreach($reversed as $value){
                       // echo   $comma_separated = implode(",",$value);?>



                                            <ul class="media-list">
                                                <li class="media">
                                                    <a href="#" class="pull-left">
                                                        <img src="https://thinkable.org/Content/Images/defaultProfile.jpg" alt="" class="img-circle">
                                                    </a>
                                                    <div class="media-body">
                                                        <span class="text-muted pull-right">
                                         <small class="text-muted">
                                             <?php 
                           $timesince = time() - strtotime($value['created_at']);
                           
                           if($timesince < 60){
                               echo $timesince . "s";
                           }
                           else if($timesince < 3600){
                               echo floor($timesince / 60) . "m";
                           }
                            else if($timesince < 86400){
                               echo floor($timesince / 3600) . "h";
                           }
                            else {
                               echo floor($timesince / 86400) . "d";
                           }
                           //$value['created_at'];?></small>
                                        </span>
                                                        <strong class="text-success">@  <?php echo $value['poster'];?></strong>
                                                        <p>
                                                            <?php echo  $value['text']; ?>

                                                        </p>
                                                    </div>
                                                </li>

                                            </ul>
                                            <?php    }?>
                        
                    
                
                                    </div>
                                </div>
                            </div>

                            <!-- TWEET WRAPPER END -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="photo-inner"><img src="https://thinkable.org/Content/Images/defaultProfile.jpg"></div>
                       <div class= underfoto>
                               <br> "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br>

                            
                          <br>  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum." <br>
                           
                         <br>  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                           
                           
                            </div>
                    
                    
                    
                    </section>

            </section>

        </section>
        









    </body>

    </html>