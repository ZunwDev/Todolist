<?php 
include "./connectToDatabase.php";

$state = $_POST['state'];
$dataID = $_POST['dataID'];

$q = "update board_data set board_check = '$state' where dataID = '$dataID'";
$result = mysqli_query($conn, $q);
