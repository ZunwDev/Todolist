<?php

include './connectToDatabase.php';
include "./getUserID.php";

$projectIDValue = $_POST['projectID'];
$board_name = $_POST['board_name'];
$board_description = $_POST['board_description'];

$qFindProjectID = "select projectID from project where project_name = $projectIDValue";
$projectIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $qFindProjectID));
$projectID = $projectIDFetch['projectID'];

$q = "insert into board (userID, projectID, board_name, board_description) values ('$userID', '$projectID', '$board_name', '$board_description')";
mysqli_query($conn, $q);