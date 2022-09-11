<?php 

include './connectToDatabase.php';

$projectName = $_POST["projectName"];

$checkIfExistsQuery = "select projectID from project where project_name = '$projectName'";
$result = mysqli_query($conn, $checkIfExistsQuery);

if (mysqli_num_rows($result) > 0) {
    $q = "delete from project where project_name = '$projectName'";
    mysqli_query($conn, $q);
}

?>