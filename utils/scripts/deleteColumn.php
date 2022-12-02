<?php

include "./connectToDatabase.php";

$id = $_POST['id'];

$q = "select dataID from board_data where boardID = '$id'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));
$dataID = $f['dataID'];

$q = "delete from board_data where dataID >= '$dataID'";
mysqli_query($conn, $q);

$q = "delete from board where boardID = '$id'";
mysqli_query($conn, $q);
