<?php
session_start();
date_default_timezone_set('America/New_York');

function checkLunch()
{
    $user = $_SESSION['UID'];
    $SID = $_SESSION['shiftID'];
    $type = "Lunch";

    $link = mysqli_connect("localhost", "root", "", "timeclockapp");
    $query = "SELECT * FROM Breaks WHERE EmpID='$user' AND ShiftID='$SID' AND Type='$type'";
    $result = mysqli_query($link, $query);
    $status = "Complete";

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["EndTime"] == NULL) {
            $breakID = $row["ID"];
            $update = "UPDATE Breaks SET Status='$status' WHERE ID='$breakID'";
            $perform = mysqli_query($link, $update);
        }
    }
}

checkLunch();
header("Location: menu.html");