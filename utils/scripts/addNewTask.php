<?php 

include './connectToDatabase.php';
include "./getUserID.php";

$boardID = $_POST['boardID'];
$nameOfTask = $_POST['nameOfTask'];

$q = "insert into board_data (userID, boardID, board_data, board_check) values ('$userID', '$boardID', '$nameOfTask', 0)";
mysqli_query($conn, $q);

?>