<?php

include '../db/connectToDatabase.php';
include "../db/getUserID.php";

$boardID = $_POST['boardID'];
$nameOfTask = $_POST['nameOfTask'];
$date = $_POST['date'];
$priorityID = $_POST['priorityID'];

$q = "insert into board_data (userID, boardID, board_data, board_check, dueTo, priorityID) values ('$userID', '$boardID', '$nameOfTask', 0, '$date', '$priorityID')";
mysqli_query($conn, $q);
