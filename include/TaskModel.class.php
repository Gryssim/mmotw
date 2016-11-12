<?php

/**
 * Created by PhpStorm.
 * User: doug
 * Date: 11/2/16
 * Time: 2:24 PM
 */

require_once("config.php");

class TaskModel
{
    function getIdByName($user_name){
        global $pdo;

        $statement = $pdo->prepare("SELECT id FROM task WHERE user_name=:user_name");
        $result = $statement->execute(array(":user_name" => $user_name));
        $row = $statement->fetch();

        if(is_array($row) && array_key_exists("id", $row)){
            return $row["id"];
        } else {
            return NULL;
        }
    }

    function getTaskBlobByDate($taskDateTime, $user_name){
        global $pdo;
        $statement = $pdo->prepare("SELECT * FROM task WHERE task_date_time = :taskDateTime 
                                                             AND user_name = :user_name");
        $result = $statement->execute(array(":taskDateTime" => $taskDateTime, ":user_name" => $user_name));

        if($result){
            return $statement->fetchAll();
        } else {
            return NULL;
        }
    }

    function saveTaskData($blob){
        global $pdo;

        $names="";
        $values="";
        $set="";
        $first = TRUE;
        foreach($blob as $id => $value){
            if($first){
                $first = FALSE;
            } else {
                $names .= ',';
                $values .= ',';
                $set .= ",";
            }
            $ncid = substr($id, 1);
            $names .= "$ncid";
            $values .= "$id";
            $set .= "$ncid = VALUES(`$ncid`)";
        }
        echo "$names\n";
        echo "$values\n";
        $sql = "INSERT INTO task ($names) VALUES ($values)";
        $statement = $pdo->prepare($sql);
        $result = $statement->execute($blob);

        echo "Result: $result\n";
        return $result;
    }
}