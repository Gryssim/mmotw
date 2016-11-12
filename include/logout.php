<?php
/**
 * Created by PhpStorm.
 * User: Doug
 * Date: 10/22/2016
 * Time: 11:15 AM
 */

require_once("config.php");
require_once("User.class.php");

$user = new User();

$user->logout();

header("Location: /mmotw/");