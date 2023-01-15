<?php
include '../db/connectToDatabase.php';
include "../db/getUserID.php";

$id = $_POST["id"];

$IDQ = "select * from project where projectID = '$id' and userID = '$userID'";
$result = mysqli_query($conn, $IDQ);

if (mysqli_num_rows($result) > 0) {
    $findBoard = "select boardID from board where projectID = '$id'";
    $fetchBoard = mysqli_fetch_assoc(mysqli_query($conn, $findBoard));
    $boardID = $fetchBoard["boardID"];

    $findBoardData = "select dataID from board_data where boardID = '$boardID'";
    $fetchData = mysqli_fetch_assoc(mysqli_query($conn, $findBoardData));

    $findProjectLogs = "select activityID from project_activity where projectID = '$id'";
    $fetchLogs = mysqli_fetch_assoc(mysqli_query($conn, $findProjectLogs));

    //Deleting tasks from boards if any exist
    if (mysqli_num_rows(mysqli_query($conn, $findBoardData)) > 0) {
        $dataID = $fetchData["dataID"];
        if ($dataID != null || !empty($dataID)) {
            $sql = "delete from board_data where dataID >= '$dataID' and projectID = '$id'";
            mysqli_query($conn, $sql);
        }
    }
    //Deleting board data from project if theres any
    if (mysqli_num_rows(mysqli_query($conn, $findBoard)) > 0) {
        if ($boardID != null || !empty($boardID)) {
            $sql = "delete from board where boardID >= '$boardID' and projectID = '$id'";
            mysqli_query($conn, $sql);
        }
    }
    // Deleting the project activity logs. */
    if (mysqli_num_rows(mysqli_query($conn, $findProjectLogs)) > 0) {
        $activityID = $fetchLogs['activityID'];
        if ($id != null || !empty($id)) {
            $sql = "delete from project_activity where activityID >= '$activityID' and projectID = '$id'";
            mysqli_query($conn, $sql);
        }
    }
    //Deleting project data
    $sql = "delete from project where projectID = '$id'";
    mysqli_query($conn, $sql);
}
