<?php
/**
 * Created by PhpStorm.
 * User: Doug
 * Date: 9/17/2016
 * Time: 10:14 PM
 */

require_once("Task.class.php");

$task = new Task();

$user_name = $_SESSION["user"]["user_name"];
$taskDate = $_POST["newDate"];
$taskTitle = $_POST["newTitle"];
$taskDescription = $_POST["newDescription"];

$task->model->saveTaskData(array(":user_name"=>$user_name,
                                 ":task_date_time"=>$taskDate,
                                 ":task_title"=>$taskTitle,
                                 ":task_description"=>$taskDescription));

header("Location: ../index.php");


