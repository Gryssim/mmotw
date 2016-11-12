<?php

/**
 * Created by PhpStorm.
 * User: doug
 * Date: 11/2/16
 * Time: 2:13 PM
 */

require_once("TaskModel.class.php");

class Task
{
  function __construct(){
      $this->user_name = null;
      $this->taskDateTime = null;
      $this->taskTitle = null;
      $this->taskDescription = null;

      $this->model = new TaskModel();
  }

  function setTask($user_name, $dateTime, $title, $description){
      $this->user_name = $user_name;
      $this->taskDateTime = $dateTime;
      $this->taskTitle = $title;
      $this->taskDescription = $description;
  }

  function save(){
    $this->model->saveTaskData(
        array(":user_name"=>$this->user_name,
        ":task_date_time"=>$this->taskDateTime,
        ":task_title"=>$this->taskTitle,
        ":task_description"=>$this->taskDescription)
    );
  }
}