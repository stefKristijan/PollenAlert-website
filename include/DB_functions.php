<?php

class DB_functions{
    private $conn;

    function __construct(){
        require_once 'DB_connect.php';

        $db = new DB_connect();
        $this->conn = $db->connect();
    }

    function __destruct(){

    }

    public function insertUser($username,$email,$password,$path,$image){
        $uniqueId = uniqid('',true);
        $hash = $this->hashSSHA($password);
        $encr_pass = $hash["encrypted"];
        $salt = $hash["salt"];

        $stmt = $this->conn->prepare("INSERT INTO user(id,unique_id,username,encr_password,salt,email,avatar_path) VALUES (NULL,?,?,?,?,?,?)");
        $stmt->bind_param("ssssss",$uniqueId,$username,$encr_pass,$salt,$email,$path);
        $result = $stmt->execute();
        $stmt->close();

        if($result){
            $stmt = $this->conn->prepare("SELECT id FROM user WHERE username=?");
            $stmt->bind_param("s",$username);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            $upload = file_put_contents($path,base64_decode($image));
            return $user;
        }
        else{
            return false;
        }
    }

    public function insertUserWeb($username,$email,$password){
        $uniqueId = uniqid('',true);
        $hash = $this->hashSSHA($password);
        $encr_pass = $hash["encrypted"];
        $salt = $hash["salt"];

        $stmt = $this->conn->prepare("INSERT INTO user(id,unique_id,username,encr_password,salt,email) VALUES (NULL,?,?,?,?,?)");
        $stmt->bind_param("sssss",$uniqueId,$username,$encr_pass,$salt,$email);
        $result = $stmt->execute();
        $stmt->close();

        if($result){
            $stmt = $this->conn->prepare("SELECT id FROM user WHERE username=?");
            $stmt->bind_param("s",$username);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        }
        else{
            return false;
        }
    }

    public function insertPollen($pollen_ids,$user_id){
    
        $array = array_values($pollen_ids);
        
        foreach($array as $pollen_id){
        $result = mysqli_query($this->conn,"INSERT INTO allergies(pollen_id,user_id) VALUES ('$pollen_id','$user_id');");
        
     }
    }

    public function insertPost($feeling, $symptoms,$city, $state,$country,$longitude,$latitude,$user_id){

        $stmt = $this->conn->prepare("INSERT INTO post(id,date,feeling,symptoms,city,state,country,longitude,latitude,user_id) VALUES (NULL,NULL,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssddi",$feeling,$symptoms,$city,$state,$country,$longitude,$latitude,$user_id);
        $result = $stmt->execute();
        $stmt->close();

       return $result;
    }

    public function getUser($username, $password){
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username LIKE ?");
        $stmt->bind_param("s",$username);

        if($stmt->execute()){
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            $salt = $user['salt'];
            $encr_pass = $user['encr_password'];
            $hash = $this->decriptHashSSHA($salt, $password);
            
            if ($encr_pass == $hash) {
                return $user;
            }
        } else {
            $stmt->close();
            return NULL;
        }
    }

    public function getUserFromId($user_id){
        $stmt = $this->conn->prepare("SELECT username, avatar_path FROM user WHERE id = ?");
        $stmt->bind_param("i",$user_id);

        if($stmt->execute()){
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        }
    }

    public function getAllPollenData(){
       $query = "SELECT * FROM pollen_data;";
       $result = mysqli_query($this->conn,$query);
       return $result;
    }

    public function getUserLocation($user_id){
        $stmt = $this->conn->prepare("SELECT * FROM location WHERE user_id=?");
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $location = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $location;
    }

    public function getUserAllergies($user_id){
        $query = "SELECT pd.id, pd.name, pd.category FROM allergies AS a, user AS u, pollen_data AS pd
                    WHERE u.id='$user_id' AND u.id=a.user_id AND a.pollen_id=pd.id;";
       $result = mysqli_query($this->conn,$query);
       return $result;
    }

    public function getAllPosts(){
        $query = "SELECT * FROM post;";
        $result = mysqli_query($this->conn,$query);
        return $result;
    }

     public function checkUserExists($username) {
        $stmt = $this->conn->prepare("SELECT username from user WHERE username LIKE ?");
 
        $stmt->bind_param("s", $username);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) { 
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

     public function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

      public function decriptHashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
 
        return $hash;
    }

    public function insertLocation($street,$street_num,$city,$state,$country,$user_id){
        $stmt = $this->conn->prepare("INSERT INTO location(id,street,street_num,city,state,country,user_id) VALUES (NULL,?,?,?,?,?,?)");
        $stmt->bind_param("sssssi",$street,$street_num,$city,$state,$country,$user_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

?>