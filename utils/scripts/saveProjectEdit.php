<?php 
include "./connectToDatabase.php";
include "./getUserID.php";

$projectName = $_POST["projectName"];
$projectDescription = $_POST["projectDescription"];
$color = $_POST["color"];
$projectID = $_POST["projectID"];

$colorIDQuery = "select colorID from colors where color_name = '$color'";
$colorIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $colorIDQuery));
$colorID = $colorIDFetch['colorID'];

$q = "update project set project_name = '$projectName', colorID = '$colorID', project_description = '$projectDescription' where projectID = '$projectID'";
mysqli_query($conn, $q);
