<?php 

include "../../scripts/db/connectToDatabase.php";

$boardID = $_POST['boardID'];
$dataID = $_POST['dataID'];

$q = "UPDATE board_data SET boardID = '$boardID' WHERE dataID = '$dataID'";
mysqli_query($conn, $q);