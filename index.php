<?php
require_once("./include/config.php");
$taskModel = new TaskModel();

if(!isset($_SESSION["user"])){
    header("Location: login.php");
}

$dayOfTheWeek = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
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
            <label> Select a Date: &nbsp; </label><input type="date" name="date" placeholder="YY-MM-DD" autocomplete="off"/>
            <input type="submit" class="btn btn-primary">
            <div id="addNew" class="addNew">Add New Task</div>
        </form>
        <br/>
        <br/>

        <div class="col-md-2">
            <?php
            //TODO: Re-order week based on $selectedDate as first day, and advance 7 days.
            $scheduleDate = $selectedDate;
            $i =  date("w", strtotime($selectedDate));
            for($j = 0; $j < 7; $j++){
                $daysTasks = $taskModel->getTaskBlobByDate($scheduleDate, $_SESSION["user"]["user_name"]);
/*                echo $_SESSION["user"]["user_name"];
                echo $scheduleDate;
                var_dump($daysTasks);*/
                echo "<div>";
                echo "<div class='dayTitle'><table><tr><td style='width:150px;'>$dayOfTheWeek[$i]&nbsp;&nbsp;</td>
                      <td style='text-align:right'>" . date("D, M d", strtotime($scheduleDate)) . "</td></tr></table></div><ul>";

                if(sizeof($daysTasks) > 0){
                    foreach($daysTasks as $tasks) {
                        echo "<li class='scheduleTask'>" . ucfirst($tasks["task_title"]) . "</li>";
                    }
                    echo "</ul></div>";
                } else {
                    echo "<li class='scheduleTask'>There are no tasks scheduled.</li></ul></div>";
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

        <div class="col-md-3" style="display:none" id="newTaskCol">
            <h3>Add a new task</h3>
            <form action="./include/addTask.php" method="POST" target="_self">
                <table>
                <tr><td><label>Date</label></td><td><input type="date" name="newDate" id="newDate" placeholder="YY-MM-DD" autocomplete="off"></td></tr> </br>
                <tr><td><label>Title<label></td><td><input type="text" name="newTitle" autocomplete="off"></td></tr> </br>
                <tr><td><label>Description</label></td><td><textarea name="newDescription" autocomplete="off"></textarea></td></tr> </br>
                </table>
                <input type="submit" value="Add Task" class="btn btn-danger">
            </form>
        </div>

        <div class="col-lg-6 todayEvents">
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
                echo "<h3> There are no events scheduled.
                              (" . date("D, M d", strtotime($selectedDate)) . ")</h3>";
            }
            ?>
        </div>

    </div>

</body>
