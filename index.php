<?php
require_once("./include/config.php");
$taskModel = new TaskModel();

if(!isset($_SESSION["user"])){
    header("Location: login.php");
}

$dayOfTheWeek = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
// TODO: fill $events with events of today's date.
if(!isset($_POST["date"]) || $_POST["date"] == NULL){
    $selectedDate = date("y-m-d");
} else {
    $selectedDate = $_POST["date"];
}
// getTaskBlobByDate(Date(yy-mm-dd), user)
$events = $taskModel->getTaskBlobByDate($selectedDate, $_SESSION["user"]["user_name"]);



require_once("./include/header.php");
// <body> tag opened in required header.php
?>

<?php
echo "&nbsp;&nbsp;&nbsp;&nbsp;$selectedDate";
?>
    <div class="container-fluid">
        <form method="POST" target="_self">
            <label> Select a Date: &nbsp; </label><input type="date" name="date" placeholder="YY-MM-DD"/>
            <input type="submit" class="btn btn-primary">
        </form>
        <br/>
        <br/>

        <div class="col-lg-5">
            <?php
            //TODO: Re-order week based on $selectedDate as first day, and advance 7 days.

            $i =  date("w", strtotime($selectedDate));
            for($j = 0; $j < 7; $j++){
                $daysTasks = $taskModel->getTaskBlobByDate($selectedDate, $_SESSION["user"]["user_name"]);
                var_dump($daysTasks);
                echo "<div>";
                echo "<label>$dayOfTheWeek[$i]</label>";
                if(sizeof($daysTasks) > 0){
                    echo "<ul><li>" . $daysTasks["task_title"] . "</li></ul>";
                } else {
                    echo "<ul><li>There are no tasks scheduled for this day.</li></ul>";
                }

                $i++;
                if($i >= 7){
                    $i = 0;
                }
                $selectedDate += date("y-m-d", strtotime($selectedDate) + (60*60*24));
            }
            /*foreach($dayOfTheWeek as $day) {
                echo "<div>";
                echo "<label>$day</label>";
                echo "<ul>";
                //TODO: serve each days events without description.
                echo "<li>Do something</li>";
                echo "</div><br/>";
            } */
            ?>
        </div>
        <div class="col-lg-10 todayEvents">
            <?php
                // var_dump for debug purposes.
                //var_dump($events);
                if(sizeof($events) > 0){
                    //TODO: List events along with default events.
                    echo "<ul>";
                    foreach($events as $event){
                        echo "<li style='font-weight: bold; font-size: 20px;'>" . ucfirst($event["task_title"]) . "</li>";
                        echo "<ul> <li style='font-size: 19px;'> " . $event["task_description"] . "</li></ul>";
                    }
                } else {
                    echo "<h3> There are no events set for today. </h3>";
                }
            ?>
        </div>

        <div class="col-lg-3">
        <?php

        ?>
        </div>
    </div>
</body>
