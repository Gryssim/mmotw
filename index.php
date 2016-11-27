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
    <div class="container-fluid">
        <form method="POST" target="_self">
            <label> Select a Date: &nbsp; </label><input type="date" name="date" placeholder="YY-MM-DD"/>
            <input type="submit" class="btn btn-primary">
        </form>
        <br/>
        <br/>

        <div class="col-md-3">
            <?php
            //TODO: Re-order week based on $selectedDate as first day, and advance 7 days.
            $scheduleDate = $selectedDate;
            $i =  date("w", strtotime($selectedDate));
            for($j = 0; $j < 7; $j++){
                $daysTasks = $taskModel->getTaskBlobByDate($scheduleDate, $_SESSION["user"]["user_name"]);
                //var_dump($daysTasks);
                echo "<div>";
                echo "<div class='dayTitle' id='addNew'><table><tr><td style='width:150px;'>$dayOfTheWeek[$i]&nbsp;&nbsp;</td><td style='text-align:right'>" . date("D, M d", strtotime($scheduleDate)) . "</td></tr></table></div><ul>";

                if(sizeof($daysTasks) > 0){
                    foreach($daysTasks as $tasks) {
                        echo "<li class='scheduleTask'>" . ucfirst($tasks["task_title"]) . "</li>";
                    }
                    echo "</ul></div>";
                } else {
                    echo "<li class='scheduleTask'>There are no tasks scheduled for this day.</li></ul></div>";
                }

                $i++;
                if($i >= 7){
                    $i = 0;
                }

                $scheduleDate = date("y-m-d", strtotime("$scheduleDate +1 day"));
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

        <div class="col-md-4" style="display:none" id="newTaskCol">
            <h3>Add a new task</h3>
            <form action="POST" target="addTask.php">
                <label>Date</label><input type="date" name="newDate" id="newDate"> </br>
                <label>Title</label><input type="text" name="newTitle"> </br>
                <label>Description</label><input type="textarea" name="newDescription"> </br>
                <input type="submit" value="Add Task" class="btn btn-danger">
            </form>
        </div>

        <div class="col-lg-4 todayEvents">
            <?php
            // var_dump for debug purposes.
            //var_dump($events);
            if(sizeof($events) > 0){
                //TODO: List events along with default events.
                echo "<label class='dayTitle'> Events for: " . date("D, M d", strtotime($selectedDate)) . "</label>";
                foreach($events as $event){
                    echo "<li class=\"taskTitle\">" . ucfirst($event["task_title"]) . "</li>";
                    echo "<li class='taskDescription''> " . $event["task_description"] . "</li>";
                }
            } else {
                echo "<h3> There are no events set for today.
                              (" . date("D, M d", strtotime($selectedDate)) . ")</h3>";
            }
            ?>
        </div>

    </div>

</body>
