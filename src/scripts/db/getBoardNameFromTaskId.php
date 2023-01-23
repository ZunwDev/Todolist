<?php

include "./connectToDatabase.php";

$taskID = $_POST['taskID'];

$q = "SELECT board.board_name FROM board_data JOIN board ON board_data.boardID = board.boardID WHERE dataID = '$taskID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));
echo $f['board_name'];