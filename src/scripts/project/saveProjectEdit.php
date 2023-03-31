<?php
include "../db/connectToDatabase.php";

$projectName = $_POST["projectName"];
$projectDescription = $_POST["projectDescription"];
$colorID = $_POST["colorID"];
$projectID = $_POST["projectID"];

$q = "update project set project_name = '$projectName', colorID = '$colorID', project_description = '$projectDescription' where projectID = '$projectID'";
mysqli_query($conn, $q);
