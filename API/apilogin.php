<?php
/**
 * Created by PhpStorm.
 * User: doug
 * Date: 11/26/16
 * Time: 10:12 AM
 */

require_once("/var/www/html/mmotw/include/User.class.php");

$user = new User();

if(isset($_REQUEST["user_name"])) {
//Set user_name from _REQUEST from app, either get or post.
    $user->setUserName($_REQUEST["user_name"]);

    $jsonReturn = array("auth" => false, "user_name" => $user->getUserName());

    header('Cache-control: no-cache, must re-validate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

    //Header to tell that result is JSON
    header('Content-type: application/json');

    if ($user->login($_REQUEST["password"])) {
        $jsonReturn["auth"] = true;
        echo json_encode($jsonReturn);
    } else {
        echo json_encode($jsonReturn);
    }
}