<?php
/**
 * Created by PhpStorm.
 * User: Doug
 * Date: 10/16/2016
 * Time: 8:10 PM
 */
require_once("User.class.php");

$user = new User();

//User name should come from user name field.
$user->setUserName("doug");


if($user->login("w4prnc4w")){
    echo "Yay!";
} else {
    echo "Boo. :(";
}