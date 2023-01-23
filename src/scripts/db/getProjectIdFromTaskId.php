<?php

include "./connectToDatabase.php";

$taskID = $_POST['taskID'];

$q = "select boardID from board_data where dataID = '$taskID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));
$boardID = $f['boardID'];

$q = "select projectID from board where boardID = '$boardID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));
echo $f['projectID'];
