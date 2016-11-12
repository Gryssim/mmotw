<?php

require_once("Session.class.php");
require_once("UserModel.class.php");
require_once("TaskModel.class.php");
require_once("Task.class.php");

// wichql9CrmRaZ8Yt

$session = new Session();

$host = "127.0.0.1";
$db = "mmotw";
$user = "mmotw";
$pass = "wichql9CrmRaZ8Yt";
$charset = "utf8";

$dsn = "mysql:host=$host; dbname=$db; charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false
];

$pdo = new PDO($dsn, $user, $pass, $opt);
