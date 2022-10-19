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
        echo '<div class="flex w-72 flex-col flex-shrink-0 h-fit bg-slate-100 px-2 pb-2 pt-2 gap-2 rounded-lg overflow-x-hidden" >';
        //Board name 
        echo '<div class="flex flex-row flex-shrink-0 transition ease-in-out duration-200 h-8 text-lg hover:bg-slate-200 rounded-lg cursor-not-allowed">';
        echo '<div class="flex px-2 my-auto">' . $boards['board_name'] . '</div>';
        echo '<div class="flex w-fit px-1 py-1 h-fit py-1 mr-1 ml-auto my-1 transition ease-in-out hover:bg-slate-300 cursor-pointer rounded-lg" onclick="showColumnEdit(`' . $boards['boardID'] . '`, `' . $project_name . '`)"><svg class="w-4 px-auto h-4 fill-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336c44.2 0 80-35.8 80-80s-35.8-80-80-80s-80 35.8-80 80s35.8 80 80 80z"/></svg></div>';
        echo '</div>';
        //Start of boards
        echo '<div id="' . $boards['boardID'] . '_name" class="overflow-y-auto flex flex-col gap-2">';
        $q = "select board_data.dataID, board_data.board_data, board_data.dueTo, board_data.board_check, priority.priority_name, priority.priority_color from board_data left join priority on board_data.priorityID = priority.priorityID where boardID = " . $boards['boardID'] . "";
        $resultBD = mysqli_query($conn, $q);
        while ($board_data = mysqli_fetch_array($resultBD)) {
            if ($board_data['board_check'] == 0) {
                //Unchecked checkboxes
                echo '<section class="flex flex-shrink-0 flex-col py-1 bg-slate-200 hover:bg-slate-300 cursor-pointer rounded-md group shadow-md relative">';
                echo '  <div class="flex-shrink-0 flex flex-row px-2">';
                echo '          <div class="flex h-6 w-6 border flex-shrink-0 border-gray-300 rounded-full bg-slate-50 cursor-pointer" onclick="isChecked(`' . $board_data['dataID'] . '`, `' . $boards['project_name'] . '`)"></div>';
                echo '  <div class="board_' . $boards['boardID'] . ' w-full flex text-sm my-auto px-2 break-words">' . $board_data['board_data'] . '</div>';
                echo '      <div title="More actions" class="flex w-fit px-2 h-fit left-[14.5rem] absolute opacity-0 transition ease-in-out hover:bg-slate-400 rounded-lg group-hover:opacity-100" onclick="showTaskManagePopup(`' . $board_data['dataID'] . '`, `' . $project_name . '`)"><svg class="w-4 px-auto h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M120 256c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm160 0c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm104 56c-30.9 0-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56s-25.1 56-56 56z"/></svg>';
                echo '  </div>';
                echo ' </div>';
                //Start of task extra part
                $date = $board_data['dueTo'];
                if ($date !== "0000-00-00" || $board_data['priority_name'] !== "None") {
                    echo '<div id="taskExtra" class="flex flex-row w-full mt-2">';
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
                    
                        echo '<div title="' . $board_data['priority_name'] . ' priority" class="flex flex-row w-fit h-fit ml-3 mb-1 ' . $board_data['priority_color'] . ' px-2 border rounded-lg border-slate-300">';
                        echo '<svg class="w-3 h-3 fill-slate-500 mt-1 mr-1"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 64c0-17.7-14.3-32-32-32S32 46.3 32 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM64 480c22.1 0 40-17.9 40-40s-17.9-40-40-40s-40 17.9-40 40s17.9 40 40 40z"/></svg>';
                        echo '<div class="priorityData text-sm flex">' . $board_data['priority_name'] . '</div>';
                        //End of priority
                        echo '</div>';
                    //End of task extra part
                    echo '</div>';
                }
                echo '</section>';
            } else {
                //Checked out checkboxes
                echo '<section class="flex flex-shrink-0 flex-row py-1 bg-lime-300 hover:bg-lime-400 cursor-pointer rounded-md group shadow-md relative">';
                echo '  <div class="flex px-2">';
                echo '      <div class="flex h-6 w-6 border border-gray-300 rounded-full bg-lime-600 cursor-pointer" onclick="isChecked(`' . $board_data['dataID'] . '`, `' . $boards['project_name'] . '`)">';
                echo '          <svg class="h-3 w-3 flex my-auto fill-white mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M470.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 338.7 425.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>';
                echo '      </div>';
                echo '  </div>';
                echo '  <div class="board_' . $boards['boardID'] . ' w-full flex line-through text-sm my-auto px-2 break-words"">' . $board_data['board_data'] . '</div>';
                echo '  <div title="More actions" class="flex w-fit px-2 h-fit left-[14.5rem] absolute opacity-0 transition ease-in-out hover:bg-lime-500 rounded-lg group-hover:opacity-100" onclick="showTaskManagePopup(`' . $board_data['dataID'] . '`, `' . $project_name . '`)"><svg class="w-4 px-auto h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M120 256c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm160 0c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm104 56c-30.9 0-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56s-25.1 56-56 56z"/></svg></div>';
                echo '</section>';
            }
        }
        //End of board
        echo '<div id="' . $boards['boardID'] . '_add" class="flex h-8 bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer" onclick="addNewTask(`' . $boards['boardID'] . '`, `'.$project_name.'`)">';
        echo '<div class="flex mx-auto my-auto">Add new task</div>';
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
