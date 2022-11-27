<?php
include './connectToDatabase.php';
include "./getUserID.php";

$projectName = $_POST["projectName"];

$IDQ = "select projectID from project where project_name = '$projectName' and userID = '$userID'";
$result = mysqli_query($conn, $IDQ);

if (mysqli_num_rows($result) > 0) {
    $projectIDF = mysqli_fetch_assoc($result);
    $projectID = $projectIDF["projectID"];

    $findBoard = "select boardID from board where projectID = '$projectID'";
    $fetchBoard = mysqli_fetch_assoc(mysqli_query($conn, $findBoard));
    $boardID = $fetchBoard["boardID"];

    $findBoardData = "select dataID from board_data where boardID = '$boardID'";
    $fetchData = mysqli_fetch_assoc(mysqli_query($conn, $findBoardData));

    //Deleting tasks from boards if any exist
    if (mysqli_num_rows(mysqli_query($conn, $findBoardData)) > 0) {
        $dataID = $fetchData["dataID"];
        if ($dataID != null || !empty($dataID)) {
            $sql = "delete from board_data where dataID >= '$dataID'";
            mysqli_query($conn, $sql);
        }
    }
    //Deleting board data from project if theres any
    if (mysqli_num_rows(mysqli_query($conn, $findBoard)) > 0) {
        if ($boardID != null || !empty($boardID)) {
            $sql = "delete from board where boardID >= '$boardID'";
            mysqli_query($conn, $sql);
        }
    }
    //Deleting project data
    $sql = "delete from project where projectID = '$projectID'";
    mysqli_query($conn, $sql);
}
