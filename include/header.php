<?php
/**
 * Created by PhpStorm.
 * User: Doug
 * Date: 9/16/2016
 * Time: 1:20 PM
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" type="text/css" href="./CSS/style.css">
        <script src="./js/script.js"></script>
        <title>MMOTW</title>
    </head>
    <body>
    <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <a class="navbar-brand" href="/mmotw/">Mirror Mirror OTW </a>
            <?php if(isset($_SESSION["user"])) {
                    if ($_SESSION["user"]["auth"]) {
                        echo "</br><div class='headerWelcome'> Welcome, " . ucfirst($_SESSION["user"]["user_name"]) . "&nbsp;&nbsp;" ?>
                        <a href="./include/logout.php">Logout</a>
                <?php }
            }   echo "</div>"?>
        </div>
    </div>

