<?php
/**
 * Created by PhpStorm.
 * User: doug
 * Date: 11/9/16
 * Time: 2:27 PM
 */

require_once("TaskModel.class.php");
require_once("Task.class.php");

$taskModel = new TaskModel();

//MUST FORMAT DATE YY-MM-DD

$date = "17-11-09";
$user = strtolower($argv[1]);



$blob = $taskModel->getTaskBlobByDate($date, $user);

var_dump($blob);
