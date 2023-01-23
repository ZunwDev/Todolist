<?php
include '../db/connectToDatabase.php';

$id = $_POST["id"];

$q = "delete from board_data where dataID = '$id'";
mysqli_query($conn, $q);
