<?php
session_start();

echo "<button type=submit><a href='menu.html'>Return to the previous menu</a></button>";

function makeReport(){
    $user = $_SESSION['UID'];
    $link = mysqli_connect("timeclockapplication.mariadb.database.azure.com", "Collin@timeclockapplication", "Chickinnugg26", "timeclockapplication", "3306");
    $shiftquery = "SELECT * FROM Shifts WHERE EmpID='$user' ORDER BY Date DESC";
    $shiftresult = mysqli_query($link, $shiftquery);

    $breaksquery = "SELECT * FROM Breaks WHERE EmpID='$user' ORDER BY ShiftID DESC";
    $breaksresult = mysqli_query($link, $breaksquery);

    echo "<h1>Here is the history of employee {$user}'s shift punch activity:</h1></br>";
    echo "<table border='1px' cellpadding='10px'><tr><th>Date</th><th>Start Time</th><th>End Time</th><th>Status</th></tr>";
    while ($row = mysqli_fetch_assoc($shiftresult)) {
        echo "<tr><td>{$row['Date']}</td><td>{$row['StartTime']}</td><td>{$row['EndTime']}</td><td>{$row['Status']}</td></tr>";
    }
    echo "</table>";

    echo "<h1>Here is the history of employee {$user}'s break punch activity:</h1></br>";
    echo "<table border='1px' cellpadding='10px'><tr><th>Start Time</th><th>End Time</th><th>Punch Type</th><th>Status</th></tr>";
    while($row2 = mysqli_fetch_assoc($breaksresult)) {
        echo "<tr><td>{$row2['StartTime']}</td><td>{$row2['EndTime']}</td><td>{$row2['Type']}</td><td>{$row2['Status']}</td></tr>";
    }
    echo "</table></br>";

    echo "<button type=submit><a href='menu.html'>Return to the previous menu</a></button>";
}

makeReport();