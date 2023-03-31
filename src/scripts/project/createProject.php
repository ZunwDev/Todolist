<?php
include "../db/connectToDatabase.php";
include "../db/getUserID.php";

$projectName = $_POST["projectName"];
$projectDescription = $_POST["projectDescription"];
$colorID = $_POST["colorID"];

$q = "insert into project (userID, project_name, colorID, project_description) values ('$userID', '$projectName', '$colorID', '$projectDescription')";
mysqli_query($conn, $q);
