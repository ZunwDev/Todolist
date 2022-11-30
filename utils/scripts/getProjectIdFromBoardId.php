<?php

include "./connectToDatabase.php";

$boardID = $_POST['boardID'];

$q = "select projectID from board where boardID = '$boardID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));
echo $f['projectID'];