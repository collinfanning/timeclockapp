<?php
session_start();

$username = trim($_POST['uname']);
$password = trim($_POST['pwd']);



$Error = "Incorrect username or password.";
$message = "Login failed";

$link = mysqli_connect("timeclockapplication.mariadb.database.azure.com", "Collin@timeclockapplication", "Chickinnugg26", "timeclockapplication", "3306");

$query = "SELECT * FROM User WHERE Name='$username'";

$result = mysqli_query($link, $query);
//$rows = mysqli_num_rows($result);

$row = mysqli_fetch_assoc($result);


if($username == $row["Name"] && $password == $row["Password"]){
    $_SESSION['name'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['UID'] = $row["ID"];
    header("Location: menu.html");
}else{
    $_SESSION['error'] = $Error;
    header("Location: index.html");
}