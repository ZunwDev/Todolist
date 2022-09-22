<?php
include "./scripts/connectToDatabase.php";
$project_name = $_POST['project_name'];

$projectIDQuery = "select projectID from project where project_name = '$project_name'";
$projectIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $projectIDQuery));
$projectID = $projectIDFetch['projectID'];

$q = "select project.project_name, board.boardID, board.board_name, board.board_description from board join project on project.projectID = board.projectID where board.projectID = '$projectID'";
$result = mysqli_query($conn, $q);

if (mysqli_num_rows($result) > 0) {
    while ($boards = mysqli_fetch_assoc($result)) {
        //Set flex area
        echo '<div class="flex flex-col ml-4 mt-4">';
        //Board name 
        echo '<div class="flex w-56 transition ease-in-out duration-200 h-8 text-lg bg-slate-200 hover:bg-slate-300 rounded-tr-md rounded-tl-md cursor-pointer">';
        echo '<div class="flex px-2 my-auto">' . $boards['board_name'] . '</div>';
        echo '</div>';
        //Start of boards
        echo '<div id="' . $boards['boardID'] . '_name" class="flex flex-col w-full">';
        $q = "select dataID, board_data, board_check from board_data where boardID = " . $boards['boardID'] . "";
        $resultBD = mysqli_query($conn, $q);
        while ($board_data = mysqli_fetch_array($resultBD)) {
            if ($board_data['board_check'] == 0) {
                //Unchecked checkboxes
                echo '<div class="w-56 h-fit mt-0.5 bg-slate-200 flex flex-row flex-grow break-words">';
                echo '<div class="flex py-1 px-1">';
                echo '<input class="flex form-check-input appearance-none h-6 w-6 border border-gray-300 rounded-full bg-white checked:bg-lime-600 checked:border-lime-600 focus:outline-none transition duration-200 cursor-pointer" type="checkbox" onclick="isChecked(`' . $board_data['dataID'] . '`, `' . $boards['project_name'] . '`)">';
                echo '</div>';
                echo '<div class="board_' . $boards['boardID'] . ' flex text-xs my-auto py-1 px-2"">' . $board_data['board_data'] . '</div>';
                echo '</div>';
            } else {
                //Checked out checkboxes
                echo '<div title="Task is completed" class="w-56 h-fit mt-0.5 bg-lime-300 flex flex-row flex-grow break-words">';
                echo '<div class="flex py-1 px-1">';
                echo '<input class="flex form-check-input appearance-none h-6 w-6 border border-gray-300 rounded-full bg-white checked:bg-lime-600 checked:border-lime-600 focus:outline-none transition duration-200 cursor-pointer" type="checkbox" onclick="isChecked(`' . $board_data['dataID'] . '`, `' . $boards['project_name'] . '`)" checked>';
                echo '</div>';
                echo '<div class="board_' . $boards['boardID'] . ' flex text-xs line-through my-auto py-1 px-2">' . $board_data['board_data'] . '</div>';
                echo '</div>';
            }
        }
        //End of board
        echo '</div>';
        //Adding new task
        echo '<div class="flex my-2 w-56 h-8 bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer" onclick="addNewTask(`' . $boards['boardID'] . '`)">';
        echo '<div class="flex mx-auto my-auto">Add new task</div>';
        echo '</div>';
        //Confirm adding new tasks
        echo '<div id="' . $boards['boardID'] . '_confirm" class="flex w-56 mb-2 h-8 bg-lime-400 hover:bg-lime-500 rounded-md cursor-pointer hidden" onclick="saveAllAtOnce(`' . $boards['boardID'] . '`, `' . $boards['project_name'] . '`)">';
        echo '<div class="flex mx-auto my-auto">Confirm changes</div>';
        echo '</div>';
        //Cancel adding tasks
        echo '<div id="' . $boards['boardID'] . '_cancel" class="flex w-56 mb-2 h-8 bg-red-400 hover:bg-red-500 rounded-md cursor-pointer hidden" onclick="cancelChanges(`' . $boards['boardID'] . '`)">';
        echo '<div class="flex mx-auto my-auto">Cancel changes</div>';
        echo '</div>';
        //End of flex area
        echo '</div>';
    }
    echo '<div title="Create a new column" class="newBoard flex mt-4 ml-4 w-56 transition ease-in-out duration-200 h-8 my-auto text-lg bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer" onclick="addBoard(' . $project_name . ')">';
    echo '<span class="mx-auto text-2xl">+</span>';
    echo '</div>';
} else {
    echo '<div title="Create a new column" class="newBoard flex mt-4 ml-4 w-56 transition ease-in-out duration-200 h-8 my-auto text-lg bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer" onclick="addBoard(' . $project_name . ')">';
    echo '<span class="mx-auto text-2xl">+</span>';
    echo '</div>';
}
