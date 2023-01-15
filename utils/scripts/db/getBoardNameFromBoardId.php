<?php

include "./connectToDatabase.php";

$boardID = $_POST['boardID'];

$q = "SELECT board_name FROM board WHERE boardID = '$boardID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));
echo $f['board_name'];