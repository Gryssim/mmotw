<?php
/**
 * Created by PhpStorm.
 * User: Doug
 * Date: 10/16/2016
 * Time: 9:13 PM
 */
require_once("./include/config.php");
require_once("./include/header.php");
?>

<div class="modal-body">
    <form method="post" action='./include/doLogin.php' name="login_form">
        <p><input type="text" class="span3" name="user_name" id="email" placeholder="User Name"></p>
        <p><input type="password" class="span3" name="password" placeholder="Password"></p>
        <p><button type="submit" class="btn btn-primary">Sign in</button>
        </p>
    </form>
</div>