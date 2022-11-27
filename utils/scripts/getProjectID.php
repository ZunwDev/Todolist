<?php 

include "./connectToDatabase.php";
include "./getUserID.php";

$project_name = $_POST['project_name'];

$q = "select projectID from project where project_name = '$project_name' and userID = '$userID'";
$fq = mysqli_fetch_assoc(mysqli_query($conn, $q));
echo $fq['projectID'];

?>