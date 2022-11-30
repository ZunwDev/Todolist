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

$checkIfExistsInDb = "select projectID from project where projectID like '$projectID'";
$checkRes = mysqli_query($conn, $checkIfExistsInDb);

$q = "insert into project (userID, project_name, colorID, project_description) values ('$userID', '$projectName', '$colorID', '$projectDescription')";
mysqli_query($conn, $q);
