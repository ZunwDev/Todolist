<?php

include '../db/connectToDatabase.php';

$dataID = $_POST['dataID'];
$task_name = $_POST['task_name'];
$task_description = $_POST['task_description'];
$task_dueTo = $_POST['task_dueTo'];
$priorityID = $_POST['task_priority'];

$q = "update board_data set board_data = '$task_name', board_data_description = '$task_description', dueTo = '$task_dueTo', priorityID = '$priorityID' where dataID = '$dataID'";
mysqli_query($conn, $q);
