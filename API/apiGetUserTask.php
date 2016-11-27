<?php
/**
 * Created by PhpStorm.
 * User: doug
 * Date: 11/26/16
 * Time: 6:51 PM
 */

require_once("/var/www/html/mmotw/include/Task.class.php");


$task = new Task();

if(isset($_REQUEST["user_name"])){
    $jsonReturn = $task->model->getTaskBlobByDate($_REQUEST["date_time"], $_REQUEST["user_name"]);

    header('Cache-control: no-cache, must re-validate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

    //Header to tell that result is JSON
    header('Content-type: application/json');

    echo json_encode($jsonReturn);
}