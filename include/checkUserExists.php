 <?php
 
    require_once 'DB_functions.php';
    $db = new DB_functions();

    if (isset($_POST['username'])){
        $username=$_POST['username'];

        $result=$db->checkUserExists($username);

        if($result){
            $response["exists"]=true;
            echo json_encode($response);
        }
        else{
            $response["exists"]=false;
            echo json_encode($response);
        }
    }
    ?>