<?php
include "../db/connectToDatabase.php";
include "../db/getUserID.php";

$projectName = $_POST["projectName"];
$projectDescription = $_POST["projectDescription"];
$color = $_POST["color"];

$colorIDQuery = "select colorID from colors where color_name = '$color'";
$colorIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $colorIDQuery));
$colorID = $colorIDFetch['colorID'];

$q = "insert into project (userID, project_name, colorID, project_description) values ('$userID', '$projectName', '$colorID', '$projectDescription')";
mysqli_query($conn, $q);
