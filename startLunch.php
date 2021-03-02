<?php
session_start();
date_default_timezone_set('America/New_York');

function checkShift()
{
    $user = $_SESSION['UID'];
    $link = mysqli_connect("timeclockapplication.mariadb.database.azure.com", "Collin@timeclockapplication", "Chickinnugg26", "timeclockapplication", "3306");
    $query = "SELECT * FROM Shifts WHERE EmpID='$user'";
    $result = mysqli_query($link, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["EndTime"] == NULL) {
            $_SESSION['shiftID'] = $row["ID"];
            checkLunch();
        }
    }
}

function checkLunch(){
        $user = $_SESSION['UID'];
        $SID = $_SESSION['shiftID'];
        $link = mysqli_connect("timeclockapplication.mariadb.database.azure.com", "Collin@timeclockapplication", "Chickinnugg26", "timeclockapplication", "3306");
        $check = "SELECT * FROM Breaks WHERE shiftID='$SID'";
        $result = mysqli_query($link, $check);

        while ($row = mysqli_fetch_assoc($result)) {
            if (($row["EndTime"] == NULL) && ($row["Type"] == "Lunch")) {
                return;
            }
        }
        allowPunch();
}

function allowPunch(){
    $user = $_SESSION['UID'];
    $SID = $_SESSION['shiftID'];
    $startTime = date("Y-m-d H:i:s");
    $type = "Lunch";
    $link = mysqli_connect("timeclockapplication.mariadb.database.azure.com", "Collin@timeclockapplication", "Chickinnugg26", "timeclockapplication", "3306");
    $insert = "INSERT INTO Breaks (EmpID, ShiftID, StartTime, Type) VALUES ('$user', '$SID', '$startTime', '$type')";
    $result = mysqli_query($link, $insert);
    //header("location: index.html");

}

checkShift();
header("Location: menu.html");