<?php

include "./connectToDatabase.php";

$boardID = $_POST['boardID'];
$board_name = $_POST['board_name'];

$q = "update board set board_name = '$board_name' where boardID = '$boardID'";
mysqli_query($conn, $q);