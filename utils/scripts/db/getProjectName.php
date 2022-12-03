<?php

include "./connectToDatabase.php";

$projectID = $_POST['projectID'];

$q = "select project_name from project where projectID = '$projectID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));
echo $f['project_name'];
