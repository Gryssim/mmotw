<?php
/**
 * Created by PhpStorm.
 * User: Doug
 * Date: 10/16/2016
 * Time: 5:57 PM
 */

require_once("config.php");
require_once("User.class.php");
require_once("UserModel.class.php");

$testModel = new UserModel();
$user = new User();

$user->setUserName($_POST["user_name"]);

if($user->login($_POST["password"])){
    header("Location: /mmotw/index.php");
} else {
    header("Location: /mmotw/login.php");
}

