<?php
 
require_once 'include/DB_functions.php';
$db = new DB_functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['submit'])) {
 
    // receiving the post params
    $username = $_POST['sign-up-username'];
    $email = $_POST['email'];
    $password = $_POST['sign-up-password'];
    $pollen_id=$_POST['pollen'];
        // create a new user
        $user = $db->insertUserWeb($username, $email, $password);
        if ($user) {
            $id = $user["id"];
            $pollen_succ=$db->insertPollen($pollen_id,$id);
            
            }
            header("Location: ../index.php");
        } else {
            // user failed to store
            header("Location: ../index.php?error");
        }
?>