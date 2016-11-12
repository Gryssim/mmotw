<?php
/**
 * Created by PhpStorm.
 * User: Doug
 * Date: 10/16/2016
 * Time: 5:57 PM
 */
require_once("UserModel.class.php");

class User{

    function __construct(){
        if(array_key_exists("user", $_SESSION)){
            $this->user_name = $_SESSION["user"];
        } else {
            $this->user_name = "unknown";
        }
        $this->model = new UserModel();
        $this->hash="";

        $this->salt = "";
    }

    function getUserName(){
        return $this->user_name;
    }

    function setUserName($user_name){
        $this->user_name = $user_name;
        $_SESSION["user"]["user_name"] = $user_name;
    }

    function setPassword($password){
        $this->hash = $this->model->makeHash($this->user_name, $this->salt, $password);
    }

    function setSalt(){
        $this->salt = $this->model->makeSalt();
    }

    function save(){
        $this->model->saveUserData(
            array(":user_name"=>$this->user_name,
                    ":hash"=>$this->hash,
                    ":salt"=>$this->salt)
        );
    }

    function login($password){
        $user_name=$this->getUserName();
        $userId=$this->model->getIdByName($user_name);
        if($userId == NULL){
            return FALSE;
        }

        $userData = $this->model->getUserDataById($userId);
        $salt = $userData["salt"];
        $hash1 = $this->model->makeHash($user_name, $salt, $password);
        $hash2 = $userData["hash"];

        if($hash1 === $hash2){
            $_SESSION["user"]["auth"] = TRUE;
            return TRUE;
        }
        return FALSE;
    }

    function isLoggedIn(){
        if(isset($_SESSION["user"])){
            if(isset($_SESSION["user"]["auth"])){
                return $_SESSION["user"]["auth"];
            }
        }
        return FALSE;
    }

    function logout(){
        global $session;
        $session->destroy();
    }


}