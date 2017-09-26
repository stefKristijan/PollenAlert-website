<?php
 
require_once 'include/DB_functions.php';
$db = new DB_functions();
 
if (isset($_POST['feeling']) && isset($_POST['symptoms']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['country'])&& isset($_POST['longitude']) && isset($_POST['latitude'])&& isset($_POST['user_id'])) {
 
    // receiving the post params
    $feeling= $_POST['feeling'];
    $symptoms= $_POST['symptoms'];
    $city = $_POST['city'];
    $state= $_POST['state'];
    $country= $_POST['country'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $user_id= $_POST['user_id'];
    
    $result = $db->insertPost($feeling,$symptoms,$city,$state,$country,$longitude,$latitude,$user_id);
    if($result){
        $response["error"]=FALSE;
        echo json_encode($response);
    }
    else{
        $response["error"] = TRUE;
        $response["error_msg"] = "Unknown error occurred in posting!";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Please choose some values!";
    echo json_encode($response);
}
?>