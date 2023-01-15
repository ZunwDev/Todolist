<?php

include "./connectToDatabase.php";

$taskID = $_POST['taskID'];

$q = "SELECT board_data FROM board_data WHERE dataID = '$taskID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));
echo $f['board_data'];