<?php
include "./scripts/connectToDatabase.php";
include "./scripts/Utils.php";

$project_name = $_POST['project_name'];

$projectIDQuery = "select projectID from project where project_name = '$project_name'";
$projectIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $projectIDQuery));
$projectID = $projectIDFetch['projectID'];

$q = "select project.project_name, board.boardID, board.board_name, board.board_description from board join project on project.projectID = board.projectID where board.projectID = '$projectID'";
$result = mysqli_query($conn, $q);

if (mysqli_num_rows($result) > 0) {
    while ($boards = mysqli_fetch_assoc($result)) {
        //Set flex area
        echo '<div class="flex-shrink-0 overflow-y-auto overflow-x-hidden mb-2">';
        echo '<div class="flex w-72 flex-col flex-shrink-0 h-fit bg-slate-100 px-2 pb-2 gap-2 rounded-lg overflow-y-auto overflow-x-hidden">';
        //Board name 
        echo '<div class="flex flex-shrink-0 transition ease-in-out duration-200 h-8 text-lg hover:bg-slate-300 cursor-pointer">';
        echo '<div class="flex px-2 my-auto">' . $boards['board_name'] . '</div>';
        echo '</div>';
        //Start of boards
        echo '<div id="' . $boards['boardID'] . '_name" class="overflow-auto flex flex-col gap-2">';
        $q = "select board_data.dataID, board_data.board_data, board_data.dueTo, board_data.board_check, priority.priority_name, priority.priority_color from board_data left join priority on board_data.priorityID = priority.priorityID where boardID = " . $boards['boardID'] . "";
        $resultBD = mysqli_query($conn, $q);
        while ($board_data = mysqli_fetch_array($resultBD)) {
            if ($board_data['board_check'] == 0) {
                //Unchecked checkboxes
                echo '<section class="flex flex-shrink-0 flex-col bg-slate-200 hover:bg-slate-300 cursor-pointer rounded-md group shadow-md relative">';
                echo '  <div class="flex-shrink-0 px-1 py-1 flex flex-row break-words">';
                echo '          <div class="flex h-6 w-6 border border-gray-300 rounded-full bg-slate-50 cursor-pointer" onclick="isChecked(`' . $board_data['dataID'] . '`, `' . $boards['project_name'] . '`)"></div>';
                echo '  <div class="board_' . $boards['boardID'] . ' w-full flex text-sm my-auto py-1 px-2 break-words">' . $board_data['board_data'] . '</div>';
                echo '      <div title="More actions" class="flex w-fit px-2 h-fit py-1 mr-1 my-1 left-[14.5rem] absolute opacity-0 transition ease-in-out hover:bg-slate-400 rounded-lg group-hover:opacity-100" onclick="showTaskManagePopup(`' . $board_data['dataID'] . '`, `' . $project_name . '`)"><svg class="w-4 px-auto h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M120 256c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm160 0c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm104 56c-30.9 0-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56s-25.1 56-56 56z"/></svg>';
                echo '  </div>';
                echo ' </div>';
                //Start of task extra part
                echo '<div id="taskExtra" class="flex flex-row w-full">';
                $date = $board_data['dueTo'];
                if ($date == "0000-00-00") {
                    $date = null;
                } else {
                    $currentDate = date('Y-m-d');
                    $nextDate = date('Y-m-d', strtotime(' +1 day'));
                    $myDateTime = DateTime::createFromFormat('Y-m-d', $date);
                    $dateToCompare = $myDateTime->format('Y-m-d');
                    $newDateString = $myDateTime->format('d. M');
                    if ($dateToCompare === $nextDate) {
                        $newDateString = "Tomorrow";
                    };
                    if ($dateToCompare === $currentDate) {
                        $newDateString = "Today";
                    };
                    if ($dateToCompare < $currentDate) {
                        $newDateString = "Late";
                    }
                    switch ($newDateString) {
                        case "Today":
                            $color = "lime";
                            break;
                        case "Tomorrow":
                            $color = "amber";
                            break;
                        case "Late":
                            $color = "red";
                            break;
                        default:
                            $color = "slate";
                            break;
                    }
                    //Dates
                    echo '<div title="' . $dateToCompare . '" class="flex flex-row w-fit h-fit ml-3 mb-1 bg-' . $color . '-100 px-2 border rounded-lg border-slate-300">';
                    echo '<svg class="w-3 h-3 fill-slate-500 mt-1 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z"/></svg>';
                    echo '<div class="dueToData text-sm flex">' . $newDateString . '</div>';
                    echo '</div>';
                    //Priorities
                };
                if ($board_data['priority_name'] !== "None" && $board_data['priority_name'] !== null) {
                    echo '<div title="' . $board_data['priority_name'] . ' priority" class="flex flex-row w-fit h-fit ml-3 mb-1 ' . $board_data['priority_color'] . ' px-2 border rounded-lg border-slate-300">';
                    echo '<svg class="w-3 h-3 fill-slate-500 mt-1 mr-1"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 64c0-17.7-14.3-32-32-32S32 46.3 32 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM64 480c22.1 0 40-17.9 40-40s-17.9-40-40-40s-40 17.9-40 40s17.9 40 40 40z"/></svg>';
                    echo '<div class="priorityData text-sm flex">' . $board_data['priority_name'] . '</div>';
                    //End of priority
                    echo '</div>';
                }
                //End of task extra part
                echo '</div>';
                echo '</section>';
            } else {
                //Checked out checkboxes
                echo '<section class="flex flex-shrink-0 flex-row bg-lime-300 hover:bg-lime-400 cursor-pointer rounded-md group shadow-md relative">';
                echo '  <div class="flex break-words py-1 px-1">';
                echo '      <div class="flex h-6 w-6 border border-gray-300 rounded-full bg-lime-600 cursor-pointer" onclick="isChecked(`' . $board_data['dataID'] . '`, `' . $boards['project_name'] . '`)">';
                echo '          <svg class="h-3 w-3 flex my-auto fill-white mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M470.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 338.7 425.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>';
                echo '  </div>';
                echo '</div>';
                echo '<div class="board_' . $boards['boardID'] . ' w-full flex line-through text-sm my-auto py-1 px-2 break-words"">' . $board_data['board_data'] . '</div>';
                echo '<div title="More actions" class="flex w-fit px-2 h-fit py-1 mr-1 my-1 left-[14.5rem] absolute opacity-0 transition ease-in-out hover:bg-lime-500 rounded-lg group-hover:opacity-100" onclick="showTaskManagePopup(`' . $board_data['dataID'] . '`, `' . $project_name . '`)"><svg class="w-4 px-auto h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M120 256c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm160 0c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm104 56c-30.9 0-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56s-25.1 56-56 56z"/></svg></div>';
                echo '</section>';
            }
        }
        //End of board
        echo '<div class="flex flex-col gap-2">';
        echo '<div id="' . $boards['boardID'] . '_add" class="flex h-8 bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer" onclick="addNewTask(`' . $boards['boardID'] . '`)">';
        echo '<div class="flex mx-auto my-auto">Add new task</div>';
        echo '</div>';
        //Confirm adding new tasks
        echo '<div id="' . $boards['boardID'] . '_confirm" class="flex h-8 bg-lime-400 hover:bg-lime-500 rounded-md cursor-pointer hidden" onclick="saveData(`' . $boards['boardID'] . '`, `' . $boards['project_name'] . '`)">';
        echo '<div class="flex mx-auto my-auto">Confirm changes</div>';
        echo '</div>';
        //Cancel adding tasks
        echo '<div id="' . $boards['boardID'] . '_cancel" class="flex h-8 bg-red-400 hover:bg-red-500 rounded-md cursor-pointer hidden" onclick="cancelChanges(`' . $boards['boardID'] . '`)">';
        echo '<div class="flex mx-auto my-auto">Cancel changes</div>';
        echo '</div>';
        echo '</div>';
        //End of flex area
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    include "./loadBoardNewButton.php";
} else {
    include "./loadBoardNewButton.php";
}
