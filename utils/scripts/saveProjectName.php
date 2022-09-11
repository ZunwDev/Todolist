<?php 
session_start();
include 'connectToDatabase.php';

$oldName = $_POST['oldName'];
$newName = $_POST['newName'];

$username = $_SESSION['login_user'];
$userIDQuery = "select userID from user where username = '$username'";
$userIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $userIDQuery));
$userID = $userIDFetch['userID'];

echo $userID;
$projectIDQuery = "select projectID from project where project_name = '$oldName' and userID = '$userID'";
$projectIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $projectIDQuery));
$projectID = $projectIDFetch['projectID'];

$updateQuery = "update project set project_name = '$newName' where projectID = '$projectID'";
mysqli_query($conn, $updateQuery);
