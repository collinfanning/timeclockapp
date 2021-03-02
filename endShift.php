<?php
session_start();
date_default_timezone_set('America/New_York');

function checkShift(){
    $user = $_SESSION['UID'];
    $name= $_SESSION['name'];
    $link = mysqli_connect("timeclockapplication.mariadb.database.azure.com", "Collin@timeclockapplication", "Chickinnugg26", "timeclockapplication", "3306");
    $query = "SELECT * FROM Shifts WHERE EmpID='$user'";
    $result = mysqli_query($link, $query);
    $rows = mysqli_num_rows($result);
    //$status="Complete";

    while($row = mysqli_fetch_assoc($result)) {
        if($row["EndTime"] == NULL){
            checkOthers();
            //$update = "UPDATE Shifts SET Status='$status' WHERE EmpID='$user'";
            //$perform =  mysqli_query($link, $update);
        }
    }

}

function checkOthers(){
    $user = $_SESSION['UID'];
    $SID = $_SESSION['shiftID'];
    $link = mysqli_connect("timeclockapplication.mariadb.database.azure.com", "Collin@timeclockapplication", "Chickinnugg26", "timeclockapplication", "3306");
    $query = "SELECT * FROM Breaks WHERE EmpID='$user' AND ShiftID='$SID'";
    $result = mysqli_query($link, $query);
    $status="Complete";
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["EndTime"] == NULL) {
            return;
        }
    }
    $update = "UPDATE Shifts SET Status='$status' WHERE EmpID='$user'";
    $perform =  mysqli_query($link, $update);

}


checkShift();
header("Location: menu.html");
