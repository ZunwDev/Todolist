<?php 
include '../db/connectToDatabase.php';

$dataID = $_POST['dataID'];

$q = "SELECT board_check FROM board_data WHERE dataID = '$dataID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));
$state = $f['board_check'] == 0 ? 1 : 0;

$q = "update board_data set board_check = '$state' where dataID = '$dataID'";
$result = mysqli_query($conn, $q);
