<?php 
include "./connectToDatabase.php";
include "./getUserID.php";

$projectName = $_POST["projectName"];
$projectDescription = $_POST["projectDescription"];
$color = $_POST["color"];
$oldName = $_POST["oldName"];

$colorIDQuery = "select colorID from colors where color_name = '$color'";
$colorIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $colorIDQuery));
$colorID = $colorIDFetch['colorID'];

$projectIDQ = "select projectID from project where project_name = '$oldName' and userID = '$userID'";
$projectIDF = mysqli_fetch_assoc(mysqli_query($conn, $projectIDQ));
$projectID = $projectIDF['projectID'];

$projectNameQuery = "select count(project_name) from project where project_name like '$projectName%' and userID = '$userID'";
$projectNameFetch = mysqli_fetch_assoc(mysqli_query($conn, $projectNameQuery));
$projectNameCount = $projectNameFetch['count(project_name)'];

if ($projectNameCount >= 1) {
    $dupeNumber = $projectNameCount + 1;
    $newProjectName = $projectName . "#".$dupeNumber. " ";
    $q = "update project set project_name = '$newProjectName', colorID = '$colorID', project_description = '$projectDescription' where projectID = '$projectID'";
    $res = mysqli_query($conn, $q);
} else {
    $q = "update project set project_name = '$projectName', colorID = '$colorID', project_description = '$projectDescription' where projectID = '$projectID'";
    $res = mysqli_query($conn, $q);
}