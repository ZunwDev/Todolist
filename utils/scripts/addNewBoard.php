<?php

include './connectToDatabase.php';
include "./getUserID.php";

$projectID = $_POST['projectID'];
$board_name = $_POST['board_name'];
$board_description = $_POST['board_description'];

$q = "insert into board (userID, projectID, board_name, board_description) values ('$userID', '$projectID', '$board_name', '$board_description')";
mysqli_query($conn, $q);