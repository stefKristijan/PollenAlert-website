<?php
 
require_once 'include/DB_functions.php';
$db = new DB_functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])&& isset($_POST['image'])) {
 
    // receiving the post params
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $image = $_POST['image'];

    $path = "uploads/avatars/$username.jpg";
    
 
    // check if user is already existed with the same email
    if ($db->checkUserExists($username)) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "Username is already taken, please choose another!";
        echo json_encode($response);
    } else {
        // create a new user
        $user = $db->insertUser($username, $email, $password,$path,$image);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["id"]= $user["id"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Please fill up all the fields to continue!";
    echo json_encode($response);
}
?>