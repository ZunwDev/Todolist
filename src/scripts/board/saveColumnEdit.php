<?php

include "../db/connectToDatabase.php";

$boardID = $_POST['boardID'];
$board_name = $_POST['board_name'];
$board_description = $_POST['board_description'];

$q = "update board set board_name = '$board_name', board_description = '$board_description' where boardID = '$boardID'";
mysqli_query($conn, $q);
