<?php 

include "../../scripts/db/connectToDatabase.php";

$projectID = $_POST['projectID'];
$taskID = $_POST['taskID'];
$boardID = $_POST['boardID'];
$description = $_POST['description'];
$old_val = $_POST['old_val'];
$new_val = $_POST['new_val'];
$typeID = $_POST['typeID'];

$q = "INSERT INTO project_activity (projectID, taskID, boardID, typeID, description, old_value, new_value) VALUES ('$projectID', '$taskID', '$boardID', '$typeID', '$description', '$old_val', '$new_val')";
mysqli_query($conn, $q);