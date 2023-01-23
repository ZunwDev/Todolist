<?php

include "../../scripts/db/connectToDatabase.php";
include "../../scripts/db/getUserID.php";

$projectID = $_POST['projectID'];

$q = "SELECT isFavorite FROM project WHERE projectID = '$projectID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));
$isFavorite = $f['isFavorite'];

$isFav = $isFavorite == 0 ? 1 : 0;
$q = "UPDATE project SET isFavorite = '$isFav' WHERE projectID = '$projectID' AND userID = '$userID'";
mysqli_query($conn, $q);