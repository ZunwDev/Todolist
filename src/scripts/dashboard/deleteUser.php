<?php
include '../db/connectToDatabase.php';
$id = $_POST["id"];

/* Deleting the board data from the project if there is any. */
$sql = "delete board_data from board_data where userID = '$id'";
mysqli_query($conn, $sql);
//Deleting board data from project if theres any
$sql = "delete from board where userID = '$id'";
mysqli_query($conn, $sql);
// Deleting the project activity logs. */
$sql = "delete project_activity from project_activity join project on project.projectID = project_activity.projectID where project.userID = '$id'";
mysqli_query($conn, $sql);
//Deleting project data
$sql = "delete from project where userID = '$id'";
mysqli_query($conn, $sql);
//Deleting user
$sql = "delete from user where userID = '$id'";
mysqli_query($conn, $sql);
