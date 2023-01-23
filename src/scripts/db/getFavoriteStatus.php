<?php 

include "./connectToDatabase.php";

$projectID = $_POST['projectID'];

$q = "select isFavorite from project where projectID = '$projectID'";
$fetch = mysqli_fetch_assoc(mysqli_query($conn, $q));
echo $fetch['isFavorite'];