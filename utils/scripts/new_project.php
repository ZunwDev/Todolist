<?php  
session_start();

include "./connectToDatabase.php";
include "./getUserID.php";

$projectName = $_POST["projectName"];
$projectDescription = $_POST["projectDescription"];
$color = $_POST["color"];
$username = $_SESSION['login_user'];

$colorIDQuery = "select colorID from colors where color_name = '$color'";
$projectNameQuery = "select count(project_name) from project where project_name like '%$projectName%'";

$colorIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $colorIDQuery));
$projectNameFetch = mysqli_fetch_assoc(mysqli_query($conn, $projectNameQuery));

$colorID = $colorIDFetch['colorID'];
$projectNameCount = $projectNameFetch['count(project_name)'];

if ($projectNameCount > 0) {
    $dupeNumber = " " ."(".($projectNameCount + 1).")";
    $newProjectName = $projectName . $dupeNumber. " ";
    $q = "insert into project (userID, project_name, colorID, project_description) values ('$userID', '$newProjectName', '$colorID', '$projectDescription')";
    $res = mysqli_query($conn, $q);
} else {
    $q = "insert into project (userID, project_name, colorID, project_description) values ('$userID', '$projectName', '$colorID', '$projectDescription')";
    $res = mysqli_query($conn, $q);
}
