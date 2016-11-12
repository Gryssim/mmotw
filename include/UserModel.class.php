<?php

require_once("config.php");

class UserModel{

    function getUserDataById($id){
        global $pdo;

        $statement = $pdo->prepare("SELECT * FROM user WHERE id=:id");
        $result = $statement->execute(array(":id"=>$id));

        if($result) {
            return $statement->fetch();
        } else {
            return NULL;
        }
}

    function getHashByName($user_name){
        global $pdo;

        $statement = $pdo->prepare("SELECT hash FROM user WHERE user_name=:user_name");
        $result = $statement->execute(array(":user_name"=>$user_name));
        $row = $statement->fetch();

        if(is_array($row) && array_key_exists("Password", $row)){
            return $row["password"];
        } else {
            return NULL;
        }
    }

    function getAllUserId(){
        global $pdo;

        $statement = $pdo->prepare("SELECT id FROM user");
        $result = $statement->execute(array());
        $ans = array();

        while($row = $statement->fetch()) {
            array_push($ans, $row["id"]);
        }
        return $ans;
    }

    function getIdByName($user_name){
        global $pdo;

        $statement = $pdo->prepare("SELECT id FROM user WHERE user_name=:user_name");
        $result = $statement->execute(array(":user_name" => $user_name));
        $row = $statement->fetch();


        if(is_array($row) && array_key_exists("id", $row)) {
            return $row["id"];
        } else {
            return NULL;
        }
    }

    function makeSalt(){
        $salt = uniqid(mt_rand(), true);
        return $salt;
    }

    function makeHash($user_name, $salt, $password){
        return hash('sha256', "$user_name/$salt/$password");
    }

    function saveUserData($blob){
        global $pdo;

        $userId = NULL;

        if(array_key_exists(":id", $blob)){
            $userId=$blob["id"];
        } else if(array_key_exists(":user_name", $blob)){
            $userId = $this->getIdByName($blob[":user_name"]);
        }

        if ($userId !== NULL){
            $blob[":id"]=$userId;
        }

        $names="";
        $values="";
        $set="";
        $first = TRUE;
        foreach($blob as $id => $value){
            if($first){
                $first = FALSE;
            } else {
                $names .= ',';
                $values .= ',';
                $set .= ",";
            }
            $ncid = substr($id, 1);
            $names .= "$ncid";
            $values .= "$id";
            $set .= "$ncid = VALUES(`$ncid`)";
        }
        $sql = "INSERT INTO user ($names) VALUES ($values) ON DUPLICATE KEY UPDATE $set";
        $statement = $pdo->prepare($sql);
        $result = $statement->execute($blob);

        echo "Result: $result\n";
        return $result;
    }
    
    



}
