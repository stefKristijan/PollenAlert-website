<?php

session_start(); 

require_once 'include/DB_functions.php';
$db = new DB_functions();
 
 
if (isset($_POST['submit'])) {

  // receiving the post params
    $username = $_POST['username'];
    $password = $_POST['password'];
    // get the user by username and password
    $user = $db->getUser($username, $password);
 
    if ($user != false) {
        $_SESSION["id"]=$user["id"];
        $_SESSION["unique_id"] = $user["unique_id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["avatar_path"] = $user["avatar_path"];
        header("Location: ../index.php");
        exit();
    } else {
        echo "Wrong username and/or password! Please try again.";
    }
} else {
        echo "There was an error! Please try again later.";
}
?>