<?php

$host = 'sql.endora.cz:3307';
$user = 'xtodolisttodecz';
$password = 'abc';
$databaseName = 'xtodolist';
$conn = mysqli_connect($host, $user, $password, $databaseName);

if (!$conn) {
    die(' Could not connect: ' . mysqli_connect_error());
}
