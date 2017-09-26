<?php
require_once 'include/DB_functions.php';
$db = new DB_functions();

$response = array("error" => FALSE);

$pollen_data = $db->getAllPollenData();

if(mysqli_num_rows($pollen_data)>0){
    $response["error"]=FALSE;
    $response["pollen_data"]=array();
   
    while($row=mysqli_fetch_array($pollen_data)){
        $pollen =array();
        $pollen["id"]=$row["id"];
        $pollen["name"]=$row["name"];
        $pollen["category"]=$row["category"];

        array_push($response["pollen_data"],$pollen);
    }
    echo json_encode($response);
}
 else {
        $response["error"] = TRUE;
        $response["error_msg"] = "Something went wrong!";
        echo json_encode($response);
    }
?>