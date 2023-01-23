<?php

include "../../scripts/db/connectToDatabase.php";
include "../../scripts/db/getUserID.php";

$boardID = $_POST['boardID'];
$dataID = $_POST['dataID'];

//Get data from old one
$q = "SELECT * FROM board_data WHERE dataID = '$dataID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));

//Delete task from old board
$q = "DELETE FROM board_data WHERE dataID = '$dataID'";
mysqli_query($conn, $q);

//Insert into new board to bottom
$q = 'INSERT INTO board_data (userID, boardID, board_data, board_data_description, board_check, dueTo, priorityID) VALUES (' . $userID . ', ' . $boardID . ', "' . $f['board_data'] . '", "' . $f['board_data_description'] . '", ' . $f['board_check'] . ', "' . $f['dueTo'] . '", ' . $f['priorityID'] . ')';
mysqli_query($conn, $q);