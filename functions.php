<?php

// Starts the sessions
function startSession(){
    if(!isset($_SESSION)){
        session_start();
    }
}
function setSession($id, $username){
    startSession();
    $_SESSION['id'] = $id;
    $_SESSION['username'] = $username;
}

function getUserName(){
    startSession();
    return $_SESSION['username'];
}

function getUserId(){
    startSession();
    return $_SESSION['id'];
}

function logOut(){
    startSession();
    $_SESSION['id'] = '';
    $_SESSION['username'] = '';
    session_destroy();
    header("Location: index.php");
}


?>