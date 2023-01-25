<?php
include '../db/connectToDatabase.php';
include "../db/getUserID.php";

$id = $_POST["id"];

$IDQ = "select * from project where projectID = '$id' and userID = '$userID'";
$result = mysqli_query($conn, $IDQ);

if (mysqli_num_rows($result) > 0) {
    $findBoardData = "select dataID from board_data where boardID = '$boardID'";
    $findBoard = "select boardID from board where projectID = '$id'";
    $findProjectLogs = "select activityID from project_activity where projectID = '$id'";


    /* Deleting the board data from the project if there is any. */
    if (mysqli_num_rows(mysqli_query($conn, $findBoardData)) > 0 && $dataID != null || !empty($dataID)) {
        $sql = "DELETE board_data FROM board_data JOIN board ON board_data.boardID = board.boardID WHERE board.projectID = '$id'";
        mysqli_query($conn, $sql);
    }
    //Deleting board data from project if theres any
    if (mysqli_num_rows(mysqli_query($conn, $findBoard)) > 0 && $boardID != null || !empty($boardID)) {
        $sql = "delete from board where projectID = '$id'";
        mysqli_query($conn, $sql);
    }
    // Deleting the project activity logs. */
    if (mysqli_num_rows(mysqli_query($conn, $findProjectLogs)) > 0 && $id != null || !empty($id)) {
        $sql = "delete from project_activity where projectID = '$id'";
        mysqli_query($conn, $sql);
    }
    //Deleting project data
    $sql = "delete from project where projectID = '$id'";
    mysqli_query($conn, $sql);
}
