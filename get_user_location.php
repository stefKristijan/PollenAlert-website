<?php
require_once 'include/DB_functions.php';
$db = new DB_functions();

if(isset($_POST['user_id'])){

    $user_id = $_POST['user_id'];
    $location = $db->getUserLocation($user_id);

    if($location){

        $response["error"]=FALSE;
        $response["id"]=$location["id"];
        $response["street"]=$location["street"];
        $response["street_num"]=$location["street_num"];
        $response["city"]=$location["city"];
        $response["state"]=$location["state"];
        $response["country"]=$location["country"];

        echo json_encode($response);
    }
    else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Something went wrong! Please try again.";
            echo json_encode($response);
        }
}
?>