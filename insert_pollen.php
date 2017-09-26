<?php
 require_once 'include/DB_connect.php';

        $db = new DB_connect();
        $conn = $db->connect();
        /*
require_once 'include/DB_functions.php';
$db = new DB_functions();
*/
 
if (isset($_POST['pollen_id']) && isset($_POST['user_id'])) {
 
    // receiving the post params
    var_dump($_POST['pollen_id']);
    $user_id = $_POST['user_id'];

    $response["responses"] = array();
    foreach($_POST['pollen_id'] as $pollen_id){

        $stmt = $conn->prepare("INSERT INTO allergies(pollen_id,user_id) VALUES (?,?)");
        $stmt->bind_param("ii",$pollen_id,$user_id);
        $result = $stmt->execute();
        $stmt->close();
        if($result){
           array_push($response["responses"],TRUE);
        }
        else array_push($response["responses"],FALSE);
        
       /* if($db->insertPollen($pollen_id,$user_id)){
            array_push($response["responses"],TRUE);
        }
        else array_push($response["responses"],FALSE);
    }
    echo json_encode($response);*/
    }
}
?>