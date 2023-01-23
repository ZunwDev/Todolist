<?php

include '../db/connectToDatabase.php';
include "../db/getUserID.php";

$projectID = $_POST['projectID'];
$board_name = $_POST['board_name'];

$q = "insert into board (userID, projectID, board_name, board_description) values ('$userID', '$projectID', '$board_name', '')";
mysqli_query($conn, $q);
