<?php
$host = getHostByName(getHostName());
if ($host != "192.168.56.1") {
    $host = "192.168.1.110";
}
$user = "myuser";
$password = "abc";
$databaseName = "todolist";
$conn = mysqli_connect($host, $user, $password, $databaseName) or die("Error");

if (mysqli_connect_error($conn)) {
    die("Error while connecting to database. Try again later");
}
