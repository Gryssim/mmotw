<?php
/**
 * Created by PhpStorm.
 * User: Doug
 * Date: 10/16/2016
 * Time: 7:41 PM
 */

require_once("UserModel.class.php");
require_once("User.class.php");

$model = new UserModel();

$model->saveUserData(array(":user_name"=>"testName", ":hash"=>"someHash", ":salt"=>"someSalt"));

