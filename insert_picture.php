
<?php
 
require_once 'include/DB_functions.php';
$db = new DB_functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['image']) && isset($_POST['username'])) {
 
    // receiving the post params
    $image = $_POST['image'];
    $username = $_POST['username'];
    $path = "uploads/'$username'_avatar.png";
    $result = $db->insertPicture($path,$username);
    if($result){
        $response["error"]=FALSE;
        echo json_encode($response);
    }
    else{
        $response["error"] = TRUE;
        $response["error_msg"] = "Unknown error occurred in inserting picture!";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Please fill up all the fields to continue!";
    echo json_encode($response);
}
?>