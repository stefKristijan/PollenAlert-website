<?php
 
require_once 'include/DB_functions.php';
$db = new DB_functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['street']) && isset($_POST['street_num']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['country']) && isset($_POST['user_id'])) {
 
    // receiving the post params
    $street= $_POST['street'];
    $street_num= $_POST['street_num'];
    $city = $_POST['city'];
    $state= $_POST['state'];
    $country= $_POST['country'];
    $user_id= $_POST['user_id'];
    
    $result = $db->insertLocation($street,$street_num,$city,$state,$country,$user_id);
    if($result){
        $response["error"]=FALSE;
        echo json_encode($response);
    }
    else{
        $response["error"] = TRUE;
        $response["error_msg"] = "Unknown error occurred in inserting location!";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Please fill up all the fields to continue!";
    echo json_encode($response);
}
?>