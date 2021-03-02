<?php
session_start();
date_default_timezone_set('America/New_York');

function checkNotStarted(){
    $user= $_SESSION['UID'];
    $name= $_SESSION['name'];
    $today= date("Y-m-d");
    $startTime = date("Y-m-d H:i:s");
    $link = mysqli_connect("localhost", "root", "", "timeclockapp");
    $query = "SELECT * FROM Shifts WHERE EmpID='$user'";
    $result = mysqli_query($link, $query);
    //$rows = mysqli_num_rows($result);


    while($row = mysqli_fetch_assoc($result)) {
        if ($row["Status"] == "Active" && $row["EndTime"] == NULL) {
            return;
        }
    }

        $insert = "INSERT INTO Shifts (EmpID, Date, StartTime) VALUES ('$user', '$today', '$startTime')";
        if ($link->query($insert) === TRUE) {
            header("Location: index.html");
        } else {
            header("Location: menu.html");
        }
    }

checkNotStarted();
header("Location: menu.html");







