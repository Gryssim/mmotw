<?php

require_once("UserModel.class.php");

$model = new UserModel();

$salt = $model->makeSalt();
$name = "Doug";
$password = "w4prnc4w!";
$hash = $model->makeHash($name, $salt, $password);


echo "Salt: $salt<br/>";
echo "Name: $name<br/>";


echo "Full Hash with Password: $hash";

