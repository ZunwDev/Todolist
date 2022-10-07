<?php

include './connectToDatabase.php';

$dataID = $_POST['dataID'];
$task_name = $_POST['task_name'];
$task_description = $_POST['task_description'];
$task_dueTo = $_POST['task_dueTo'];
$task_priority = $_POST['task_priority'];

$q = "select priorityID from priority where priority_name = '$task_priority'";
$qf = mysqli_fetch_assoc(mysqli_query($conn, $q));
$priorityID = $qf['priorityID'];

$q = "update board_data set board_data = '$task_name', board_data_description = '$task_description', dueTo = '$task_dueTo', priorityID = '$priorityID' where dataID = '$dataID'";
mysqli_query($conn, $q);