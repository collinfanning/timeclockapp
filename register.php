<?php
session_start();
$username = trim($_POST['uname']);
$DOB = trim($_POST['DOB']);
$password = trim($_POST['pwd']);

$link = mysqli_connect("timeclockapplication.mariadb.database.azure.com", "Collin@timeclockapplication", "Chickinnugg26", "timeclockapplication", "3306");

$checknotexists = "SELECT * FROM User WHERE Name='$username' AND DOB='$DOB'";
$result = mysqli_query($link, $checknotexists);
$row = mysqli_fetch_assoc($result);

if($row === NULL){
    $insertquery = "INSERT INTO User (Name, DOB, Password) VALUES ('$username', '$DOB', '$password')";
    $insertresult = mysqli_query($link, $insertquery);
}

header("Location:index.html");