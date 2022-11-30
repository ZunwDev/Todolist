<?php 
session_start();
include 'connectToDatabase.php';

$oldName = $_POST['oldName'];
$newName = $_POST['newName'];
$projectID = $_POST['projectID'];

$username = $_SESSION['login_user'];
$userIDQuery = "select userID from user where username = '$username'";
$userIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $userIDQuery));
$userID = $userIDFetch['userID'];

$updateQuery = "update project set project_name = '$newName' where projectID = '$projectID'";
mysqli_query($conn, $updateQuery);
