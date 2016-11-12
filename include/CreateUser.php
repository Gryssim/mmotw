<?php

require_once('config.php');
require_once('User.class.php');
require_once("UserModel.class.php");

$user_name = $argv[1];
$password = $argv[2];

echo "user_name: $user_name\n";
echo "password = $password\n";


$user=new User();

$user->setUserName($user_name);
$user->setSalt();
$user->setPassword($password);


$user->save();