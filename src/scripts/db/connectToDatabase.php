<?php
//$host = "192.168.1.104";
$host = "localhost";
$user = "myuser";
$password = "abc";
$databaseName = "todolist";
$conn = mysqli_connect($host, $user, $password, $databaseName) or die("Error");

if (mysqli_connect_error($conn)) {
    die("Error while connecting to database. Try again later");
}
