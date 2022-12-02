<?php
include './connectToDatabase.php';
include "./getUserID.php";

$id = $_POST["id"];

$IDQ = "select project_name from project where id = '$id' and userID = '$userID'";
$result = mysqli_query($conn, $IDQ);

if (mysqli_num_rows($result) > 0) {
    $findBoard = "select boardID from board where id = '$id'";
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
    $sql = "delete from project where id = '$id'";
    mysqli_query($conn, $sql);
}
