<?php
include "../../scripts/db/connectToDatabase.php";
include "../../scripts/db/getUserID.php";

$projectID = $_POST['projectID'];

$projectNameQ = "SELECT project_name FROM project WHERE projectID = '$projectID'";
$projectNameF = mysqli_fetch_assoc(mysqli_query($conn, $projectNameQ));
$project_name = $projectNameF['project_name'];

$q = "SELECT project.project_name, board.boardID, board.board_name, board.board_description FROM board JOIN project ON project.projectID = board.projectID WHERE board.projectID = '$projectID'";
$result = mysqli_query($conn, $q);

function loadExtra($board_data)
{
    $date = $board_data['dueTo'];
    if ($date !== "0000-00-00" || $board_data['priority_name'] !== "None") {
        $currentTimestamp = time();
        $nextTimestamp = strtotime(' +1 day');
        $currentDate = date('Y-m-d', $currentTimestamp);
        $nextDate = date('Y-m-d', $nextTimestamp);

        $myDateTime = DateTime::createFromFormat('Y-m-d', $date);
        $dateToCompare = $myDateTime->format('Y-m-d');
        $newDateString = $myDateTime->format('d. M');

        $newDateString = $dateToCompare === $currentDate ? "Today" : ($dateToCompare === $nextDate ? "Tomorrow" : ($dateToCompare < $currentDate ? "Late" : $newDateString));

        $colors = [
            "Today" => "lime",
            "Tomorrow" => "amber",
            "Late" => "red",
            "default" => "slate",
        ];
        $color = $colors[$newDateString] ?? $colors['default'];
        //Dates
        echo '<div id="taskExtra" class="flex flex-row w-full gap-2 mt-2 mb-1 px-2">';
        if ($date !== "0000-00-00") {
            echo '<div title="' . $dateToCompare . '" class="flex flex-row w-fit gap-2 h-fit px-2 py-0.5 bg-'.$color.'-400 rounded-md">';
            echo '<svg class="w-3 h-3 my-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M232 120C232 106.7 242.7 96 256 96C269.3 96 280 106.7 280 120V243.2L365.3 300C376.3 307.4 379.3 322.3 371.1 333.3C364.6 344.3 349.7 347.3 338.7 339.1L242.7 275.1C236 271.5 232 264 232 255.1L232 120zM256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0zM48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256z"/></svg>';
            echo '<div class="dueToData text-sm flex">' . $newDateString . '</div>';
            echo '</div>';
        }
        //Priorities
        if ($board_data['priority_name'] !== "None") {
            echo '<div title="' . $board_data['priority_name'] . ' priority" class="flex flex-row w-fit gap-1 h-fit px-2 py-0.5 '.$board_data['priority_color'].' rounded-md">';
            echo '<svg class="w-3 h-3 my-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M48 24C48 10.7 37.3 0 24 0S0 10.7 0 24V64 350.5 400v88c0 13.3 10.7 24 24 24s24-10.7 24-24V388l80.3-20.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30V66.1c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L48 52V24zm0 77.5l96.6-24.2c27-6.7 55.5-3.6 80.4 8.8c54.9 27.4 118.7 29.7 175 6.8V334.7l-24.4 9.1c-33.7 12.6-71.2 10.7-103.4-5.4c-48.2-24.1-103.3-30.1-155.6-17.1L48 338.5v-237z"/></svg>';
            echo '<div class="priorityData text-sm flex">' . $board_data['priority_name'] . '</div>';
            echo '</div>';
        }
        //End of priority
        //End of task extra part
        echo '</div>';
    }
}

if (mysqli_num_rows($result) > 0) {
    while ($boards = mysqli_fetch_assoc($result)) {
        //Set flex area
        echo '<div class="flex-shrink-0 overflow-y-auto overflow-x-hidden mb-2">';
        echo '<div class="flex w-72 flex-col flex-shrink-0 h-fit px-2 pb-2 pt-2 gap-2 rounded-lg overflow-x-hidden" >';
        //Board name 
        echo '<div class="flex flex-col px-2 gap-1">';
        echo '<div class="flex flex-row flex-shrink-0 transition ease-in-out duration-200 h-8 text-lg rounded-lg">';
        echo '<div class="flex px-2 my-auto text-md font-medium">' . $boards['board_name'] . '</div>';
        $q = 'SELECT COUNT(*) as total FROM board_data WHERE boardID = ' . $boards['boardID'] . '';
        $f = mysqli_fetch_assoc(mysqli_query($conn, $q));
        $qc = 'SELECT colors.color_code FROM project JOIN colors on project.colorID = colors.colorID WHERE projectID = ' . $projectID . '';
        $fc = mysqli_fetch_assoc(mysqli_query($conn, $qc));
        $split = explode("-", $fc['color_code']);
        $mod = $split[2] - 400;
        $editColor = "bg-{$split[1]}-{$mod}/50";
        $textColor = $mod > 400 ? "text-{$split[1]}-{$mod}" : "text-{$split[1]}-{$split[2]}";
        echo '<div class="flex h-fit w-fit px-2 text-sm my-auto rounded-full ' . $editColor . " " . $textColor . ' justify-center">' . $f['total'] . '</div>';
        echo '<div class="flex w-fit px-1 py-1 h-fit py-1 ml-auto my-1 transition ease-in-out hover:bg-slate-200 cursor-pointer rounded-lg" onclick="showColumnManagePopup(`' . $boards['boardID'] . '`)"><svg class="w-4 px-auto h-4 fill-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM64 256c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H96c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg></div>';
        echo '</div>';
        echo '</div>';
        //Start of boards
        echo '<div id="' . $boards['boardID'] . '_name" class="overflow-y-auto flex flex-col gap-2">';
        $q = "select board_data.dataID, board_data.board_data, board_data.dueTo, board_data.board_check, priority.priority_name, priority.priority_color from board_data left join priority on board_data.priorityID = priority.priorityID where boardID = " . $boards['boardID'] . "";
        $resultBD = mysqli_query($conn, $q);
        while ($board_data = mysqli_fetch_array($resultBD)) {
            if ($board_data['board_check'] == 0) {
                //Unchecked checkboxes
                echo '<section id="'. $board_data['dataID'] .'_taskChecked" class="flex flex-shrink-0 flex-col py-1 bg-slate-50 rounded-md group shadow-md relative">';
                echo '  <div class="flex-shrink-0 flex flex-row px-2">';
                echo '      <div id="'. $board_data['dataID'] .'" title="Mark complete" class="flex transition duration-300 h-6 w-6 border-2 flex-shrink-0 border-gray-300 rounded-full bg-slate-50 cursor-pointer" onclick="isChecked(`' . $board_data['dataID'] . '`)">';
                echo '          <svg id="'. $board_data['dataID'] .'_check" class="h-3 w-3 flex my-auto fill-gray-300 transition duration-300 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M470.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 338.7 425.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>';
                echo '      </div>';
                echo '  <div class="w-full flex text-sm my-auto px-2 pr-8 break-all">' . $board_data['board_data'] . '</div>';
                echo '      <div title="More actions" class="flex w-fit px-2 left-[14.5rem] absolute opacity-0 cursor-pointer transition ease-in-out hover:bg-slate-200 rounded-lg group-hover:opacity-100" onclick="showTaskManagePopup(`' . $board_data['dataID'] . '`)"><svg class="w-4 px-auto h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M120 256c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm160 0c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm104 56c-30.9 0-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56s-25.1 56-56 56z"/></svg>';
                echo '  </div>';
                echo ' </div>';
                //Start of task extra part
                loadExtra($board_data);
                echo '</section>';
            } else {
                //Checked out checkboxes
                echo '<section id="'. $board_data['dataID'] .'_taskChecked" class="flex flex-shrink-0 flex-col py-1 bg-slate-50 transition duration-300 opacity-70 rounded-md group shadow-md relative">';
                echo '  <div class="flex-shrink-0 flex flex-row px-2">';
                echo '      <div id="'. $board_data['dataID'] .'" title="Mark incomplete" class="flex h-6 w-6 transition duration-300 border-2 flex-shrink-0 border-lime-600 rounded-full bg-lime-500 cursor-pointer" onclick="isChecked(`' . $board_data['dataID'] . '`)">';
                echo '          <svg id="'. $board_data['dataID'] .'_check" class="h-3 w-3 flex my-auto transition duration-300 fill-white mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M470.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 338.7 425.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>';
                echo '      </div>';
                echo '  <div class="w-full flex text-sm my-auto px-2 pr-8 break-all">' . $board_data['board_data'] . '</div>';
                echo '      <div title="More actions" class="flex w-fit px-2 left-[14.5rem] absolute opacity-0 cursor-pointer transition ease-in-out hover:bg-slate-200 rounded-lg group-hover:opacity-100" onclick="showTaskManagePopup(`' . $board_data['dataID'] . '`)"><svg class="w-4 px-auto h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M120 256c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm160 0c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm104 56c-30.9 0-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56s-25.1 56-56 56z"/></svg>';
                echo '  </div>';
                echo ' </div>';
                //Start of task extra part
                loadExtra($board_data);
                echo '</section>';
            }
        }
        //End of board
        echo '<div id="' . $boards['boardID'] . '_add" class="flex h-8 hover:bg-slate-200 rounded-md cursor-pointer transition" onclick="addNewTask(`' . $boards['boardID'] . '`)">';
        echo '<div class="flex mx-auto my-auto text-sm">+ Add task</div>';
        echo '</div>';
        echo '</div>';
        //End of flex area
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
echo '<div class="newBoard flex flex-col flex-shrink-0 transition-[height] ease-in-out duration-200 h-8 w-64 mr-4 rounded-lg">';
echo '<textarea id="newBoardInput" class="form-control rounded-tr-lg rounded-tl-lg pl-2 pt-1 h-8 transition ease-in-out duration-200 overflow-y-hidden bg-transparent hover:bg-slate-200 truncate focus:text-gray-700 focus:bg-slate-50 focus:border focus:outline-none focus:border-blue-600 hidden resize-none">Column</textarea>';
echo '<div class="w-full flex flex-row mt-auto mb-1 ml-1 gap-2">';
echo '<div title="Add a new column" class="newBoardButton flex w-64 transition-[width] ease-in-out h-8 text-gray-400 duration-200 text-lg bg-slate-100 hover:bg-slate-200 rounded-md cursor-pointer" onclick="expandBoardCreate()">';
echo '<span class="mx-auto my-auto text-sm">+ Add column</span>';
echo '</div>';
echo '<div title="Add a new column" class="acceptBoard flex w-64 transition-[width] ease-in-out duration-200 text-lg bg-lime-400 hover:bg-lime-500 rounded-md cursor-pointer hidden" onclick="addBoard(`' . $projectID . '`)">';
echo '<span class="mx-auto my-auto text-sm">Add column</span>';
echo '</div>';
echo '<div title="Close" class="newBoardCancel flex w-8 h-8 bg-slate-200 hover:bg-slate-300 rounded-lg transition z-50 ease-in-out duration-200 hidden cursor-pointer" onclick="expandBoardCreate()">';
echo '<svg class="flex w-3 h-3 mx-auto my-auto fill-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>';
echo '</div>';
//End of new board button
echo '</div>';
