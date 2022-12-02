<?php 

include "./connectToDatabase.php";

$dataID = $_POST['dataID'];

$q = "select board_check from board_data where dataID = '$dataID'";
$fetch = mysqli_fetch_assoc(mysqli_query($conn, $q));
echo $fetch['board_check'];
