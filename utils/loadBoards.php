<?php
include "./scripts/connectToDatabase.php";
$project_name = $_POST['project_name'];

$projectIDQuery = "select projectID from project where project_name = '$project_name'";
$projectIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $projectIDQuery));
$projectID = $projectIDFetch['projectID'];

$q = "select board_name, board_description from board where projectID = '$projectID'";
$result = mysqli_query($conn, $q);

if (mysqli_num_rows($result) > 0) {
    while ($boards = mysqli_fetch_assoc($result)) {
        //Set flex area
        echo '<div class="flex flex-col ml-4 mt-4">';
        //Board name 
        echo '<div class="flex w-56 transition ease-in-out duration-200 h-8 text-lg bg-slate-200 hover:bg-slate-300 rounded-tr-md rounded-tl-md cursor-pointer">';
        echo '<div class="flex px-2 my-auto">'.$boards['board_name'].'</div>';
        echo '</div>';
        echo '<div id="'.$boards['board_name'].'_name" class="flex flex-col w-full">';
        echo '</div>';
        //Adding new task
        echo '<div class="flex my-2 w-56 h-8 bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer" onclick="addNewTask(`'.$boards['board_name'].'`)">';
        echo '<div class="flex mx-auto my-auto">Add new task</div>';
        echo '</div>';
        //End of flex area
        echo '</div>';
    }
}