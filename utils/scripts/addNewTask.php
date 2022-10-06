<?php 

include './connectToDatabase.php';
include "./getUserID.php";

$boardID = $_POST['boardID'];
$nameOfTask = $_POST['nameOfTask'];
$date = $_POST['date'];
$priority = $_POST['priority'];

$q = "select priorityID from priority where priority_name = '$priority'";
$resultFetch = mysqli_fetch_assoc(mysqli_query($conn, $q));
$priorityID = $resultFetch['priorityID'];

$q = "insert into board_data (userID, boardID, board_data, board_check, dueTo, priorityID) values ('$userID', '$boardID', '$nameOfTask', 0, '$date', '$priorityID')";
mysqli_query($conn, $q);

?>