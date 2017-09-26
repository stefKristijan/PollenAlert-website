<?php
require_once 'include/DB_functions.php';
$db = new DB_functions();
 

$response = array("error" => FALSE);
 
if (isset($_POST['username']) && isset($_POST['password'])) {
 
    // receiving the post params
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    // get the user by username and password
    $user = $db->getUser($username, $password);
 
    if ($user != false) {

        $response["error"] = FALSE;
        $response["id"]=$user["id"];
        $response["unique_id"] = $user["unique_id"];
        $response["username"] = $user["username"];
        $response["email"] = $user["email"];
        $response["avatar_path"] = $user["avatar_path"];
        echo json_encode($response);
    } else {
        $response["error"] = TRUE;
        $response["error_msg"] = "Wrong username and/or password. Please try again.";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Please enter your username and password.";
    echo json_encode($response);
}
?>