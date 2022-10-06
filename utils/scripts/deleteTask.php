<?php
include './connectToDatabase.php';

$taskID = $_POST["taskID"];
echo $taskID;

$q = "delete from board_data where dataID = '$taskID'";
mysqli_query($conn, $q);
