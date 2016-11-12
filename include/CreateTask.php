<?php
/**
 * Created by PhpStorm.
 * User: doug
 * Date: 11/7/16
 * Time: 2:08 PM
 */

require_once("config.php");
require_once("TaskModel.class.php");
require_once("Task.class.php");

$task = new Task();

$user_name = $argv[1];

//format as yy-mm-dd-hh:mm:ss
$dateTime = $argv[2];
$title = $argv[3];
$description = $argv[4];

$task->setTask($user_name, $dateTime, $title, $description);

$task->save();

echo "$task->user_name\n";
echo "$task->taskDateTime\n";
echo "$task->taskTitle\n";
echo "$task->taskDescription\n";