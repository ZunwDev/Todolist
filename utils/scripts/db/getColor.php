<?php

include "./connectToDatabase.php";

$projectID = $_POST['projectID'];

$q = "select colorID from project where projectID = '$projectID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));
$colorID = $f['colorID'];

$q = "select color_code from colors where colorID = '$colorID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));
echo $f['color_code'];
