<?php
require_once 'include/DB_functions.php';
$db = new DB_functions();

    $response = array("error" => FALSE);

    $posts = $db->getAllPosts();

    if(mysqli_num_rows($posts)>0){
        $response["error"]=FALSE;
        $response["posts"]=array();
    
        while($row=mysqli_fetch_array($posts)){
            $post =array();
            $post["id"]=$row["id"];
            $post["date"]=$row["date"];
            $post["feeling"]=$row["feeling"];
            $post["symptoms"]=$row["symptoms"];
            $post["city"]=$row["city"];
            $post["state"]=$row["state"];
            $post["country"]=$row["country"];
            $post["longitude"]=$row["longitude"];
            $post["latitude"]=$row["latitude"];
            $post["user_id"]=$row["user_id"];
            $post["user"] = $db->getUserFromId($post["user_id"]);
            array_push($response["posts"],$post);
        }
        echo json_encode($response);
    }
    else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Something went wrong!";
            echo json_encode($response);
        }


?>