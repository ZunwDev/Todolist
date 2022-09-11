<?php  
include './connectToDatabase.php';

session_start();

$projectName = $_POST["projectName"];
$color = $_POST["color"];
$username = $_SESSION['login_user'];

$userIDQuery = "select userID from user where username = '$username'";
$colorIDQuery = "select colorID from colors where color_name = '$color'";
$projectNameQuery = "select count(project_name) from project where project_name like '%$projectName%'";

$userIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $userIDQuery));
$colorIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $colorIDQuery));
$projectNameFetch = mysqli_fetch_assoc(mysqli_query($conn, $projectNameQuery));

$userID = $userIDFetch['userID'];
$colorID = $colorIDFetch['colorID'];
$projectNameCount = $projectNameFetch['count(project_name)'];

if ($projectNameCount > 0) {
    $dupeNumber = " " ."(".($projectNameCount + 1).")";
    $newProjectName = $projectName . $dupeNumber. " ";
    $q = "insert into project (userID, project_name, colorID) values ('$userID', '$newProjectName', '$colorID')";
    $res = mysqli_query($conn, $q);
} else {
    $q = "insert into project (userID, project_name, colorID) values ('$userID', '$projectName', '$colorID')";
    $res = mysqli_query($conn, $q);
}
?>