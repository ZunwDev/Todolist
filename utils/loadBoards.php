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
                echo '<div title="Complete the task" class="w-56 h-fit mt-0.5 bg-slate-200 flex flex-row break-words">';
                echo '<div class="flex py-1 px-1">';
                echo '<div class="flex h-6 w-6 border border-gray-300 rounded-full bg-white cursor-pointer" onclick="isChecked(`' . $board_data['dataID'] . '`, `' . $boards['project_name'] . '`)"></div>';
                echo '</div>';
                echo '<div class="board_' . $boards['boardID'] . ' flex text-xs my-auto py-1 px-2"">' . $board_data['board_data'] . '</div>';
                echo '</div>';
            } else {
                //Checked out checkboxes
                echo '<div title="Task is completed" class="w-56 h-fit mt-0.5 bg-lime-300 flex flex-row break-words">';
                echo '<div class="flex py-1 px-1">';
                echo '<div class="flex h-6 w-6 border border-gray-300 rounded-full bg-lime-600 cursor-pointer" onclick="isChecked(`' . $board_data['dataID'] . '`, `' . $boards['project_name'] . '`)" checked>';
                echo '<svg class="h-3 w-3 flex my-auto fill-white mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M470.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 338.7 425.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>';
                echo '</div>';
                echo '</div>';
                echo '<div class="board_' . $boards['boardID'] . ' flex text-xs line-through my-auto py-1 px-2">' . $board_data['board_data'] . '</div>';
                echo '</div>';
            }
        }
        //End of board
        echo '</div>';
        //Adding new task
        echo '<div id="' . $boards['boardID'] . '_add" class="flex my-2 w-56 h-8 bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer" onclick="addNewTask(`' . $boards['boardID'] . '`)">';
        echo '<div class="flex mx-auto my-auto">Add new task</div>';
        echo '</div>';
        //Confirm adding new tasks
        echo '<div id="' . $boards['boardID'] . '_confirm" class="flex w-56 mt-2 mb-2 h-8 bg-lime-400 hover:bg-lime-500 rounded-md cursor-pointer hidden" onclick="saveData(`' . $boards['boardID'] . '`, `' . $boards['project_name'] . '`)">';
        echo '<div class="flex mx-auto my-auto">Confirm changes</div>';
        echo '</div>';
        //Cancel adding tasks
        echo '<div id="' . $boards['boardID'] . '_cancel" class="flex w-56 mb-2 h-8 bg-red-400 hover:bg-red-500 rounded-md cursor-pointer hidden" onclick="cancelChanges(`' . $boards['boardID'] . '`)">';
        echo '<div class="flex mx-auto my-auto">Cancel changes</div>';
        echo '</div>';
        //End of flex area
        echo '</div>';
    }
    echo '<div class="newBoard flex flex-col flex-shrink-0 transition-[height] ease-in-out duration-200 h-8 w-56 mx-4 mt-4 rounded-lg">';
    echo '<textarea id="newBoardInput" class="form-control rounded-tr-lg rounded-tl-lg pl-2 pt-1 h-8 transition ease-in-out duration-200 overflow-y-hidden bg-transparent hover:bg-slate-200 truncate focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600 hidden resize-none">Column</textarea>';
    echo '<div class="w-full flex flex-row mt-auto mb-1 ml-1 gap-2">';
    echo '<div title="Create a new column" class="newBoardButton flex w-56 transition-[width] ease-in-out duration-200 text-lg bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer" onclick="expandBoardCreate()">';
    echo '<span class="mx-auto text-2xl">+</span>';
    echo '</div>';
    echo '<div title="Create a new column" class="acceptBoard flex w-56 transition-[width] ease-in-out duration-200 text-lg bg-lime-300 hover:bg-lime-400 rounded-md cursor-pointer hidden" onclick="addBoard('.$project_name.')">';
    echo '<span class="mx-auto my-auto text-md">Add column</span>';
    echo '</div>';
    echo '<div title="Close" class="newBoardCancel flex w-8 h-8 bg-slate-200 hover:bg-slate-300 rounded-lg transition z-50 ease-in-out duration-200 hidden cursor-pointer" onclick="expandBoardCreate()">';
    echo '<svg class="flex w-3 h-3 mx-auto my-auto fill-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
} else {
    echo '<div class="newBoard flex flex-col flex-shrink-0 transition-[height] ease-in-out duration-200 h-8 w-56 mx-4 mt-4 rounded-lg">';
    echo '<textarea id="newBoardInput" class="form-control rounded-tr-lg rounded-tl-lg pl-2 pt-1 h-8 transition ease-in-out duration-200 overflow-y-hidden bg-transparent hover:bg-slate-200 truncate focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600 hidden resize-none">Column</textarea>';
    echo '<div class="w-full flex flex-row mt-auto mb-1 ml-1 gap-2">';
    echo '<div title="Create a new column" class="newBoardButton flex w-56 transition-[width] ease-in-out duration-200 text-lg bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer" onclick="expandBoardCreate()">';
    echo '<span class="mx-auto text-2xl">+</span>';
    echo '</div>';
    echo '<div title="Create a new column" class="acceptBoard flex w-56 transition-[width] ease-in-out duration-200 text-lg bg-lime-300 hover:bg-lime-400 rounded-md cursor-pointer hidden" onclick="addBoard('.$project_name.')">';
    echo '<span class="mx-auto my-auto text-md">Add column</span>';
    echo '</div>';
    echo '<div title="Close" class="newBoardCancel flex w-8 h-8 bg-slate-200 hover:bg-slate-300 rounded-lg transition z-50 ease-in-out duration-200 hidden cursor-pointer" onclick="expandBoardCreate()">';
    echo '<svg class="flex w-3 h-3 mx-auto my-auto fill-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
