<?php
session_start();


function makeReport(){
    $user = $_SESSION['UID'];
    $link = mysqli_connect("localhost", "root", "", "timeclockapp");
    $query = "SELECT * FROM Shifts, Breaks WHERE EmpID='$user'";


}