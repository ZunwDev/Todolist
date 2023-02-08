<?php

include "../../scripts/db/connectToDatabase.php";
include "../../scripts/db/getUserID.php";

$dataID = $_POST['dataID'];

$q = "select boardID, board_data, board_data_description, dueTo, priorityID from board_data where dataID = '$dataID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));
$task_name = $f['board_data'];
$task_description = $f['board_data_description'];
$dueTo = $f['dueTo'];
$priorityID = $f['priorityID'];
$boardID = $f['boardID'];

$prQ  = "select priority_name, priority_color from priority where priorityID = '$priorityID'";
$feP = mysqli_fetch_assoc(mysqli_query($conn, $prQ));
$priority = $feP['priority_name'];
$priority_color = $feP['priority_color'];

echo '<div id="popupOverlay" class="w-screen h-screen absolute bg-slate-50/25">';
echo '  <div id="popupElement" class="absolute flex left-0 right-0 ml-auto mr-auto beforeShowUp top-28 border border-slate-300 flex-col h-fit w-[512px] shadow-lg bg-slate-50 pb-2 rounded-lg">';
echo '      <div class="editHeader flex flex-row w-full h-8 border-b border-slate-200 gap-4">';
echo '          <div class="my-1 ml-4 w-full h-full font-bold">Task edit</div>';
echo '              <div class="ml-auto mt-1 mr-1 flex h-fit w-fit px-1 py-1 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="closeAnyPopup()"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>';
echo '          </div>';
echo '      <div class="wrap mt-4 w-full h-full px-6 space-y-2 flex flex-col">';
echo '          <div class="flex flex-col space-y-1">';
echo '              <label><strong>Task name</strong></label>';
echo '              <input id="taskNameEdit" type="text" placeholder="Type a new task name" class="flex shadow-md form-control block w-full px-2 text-base font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none" value="' . $task_name . '"></input>';
echo '          </div>';
echo '          <div class="flex flex-col space-y-1">';
echo '              <label><strong>Task description</strong></label>';
echo '              <textarea id="taskDescriptionEdit" placeholder="In-depth description..." maxlength="128" class="descriptionInput flex shadow-md h-20 form-control block w-full px-2 text-base font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none resize-none overflow-y-hidden" autocomplete="none">' . $task_description . '</textarea>';
echo '          </div>';
echo '          <div class="flex flex-col space-y-1">';
echo '              <label><strong>Change due to</strong></label>';
if ($dueTo !== "0000-00-00") {
    echo '          <input id="taskDueToEdit" class="dueTo flex w-full rounded-lg shadow-md border border-solid border-slate-300 form-control px-4 bg-slate-50 text-slate-700 border-b border-slate-300 focus:bg-slate-50 focus:border focus:outline-none focus:border-slate-600" type="date" value="' . $dueTo . '"></input>';
} else {
    echo '          <input id="taskDueToEdit" class="dueTo flex w-full rounded-lg shadow-md border border-solid border-slate-300 form-control px-4 bg-slate-50 text-slate-700 border-b border-slate-300 focus:bg-slate-50 focus:border focus:outline-none focus:border-slate-600" type="date"></input>';
}
echo '          </div>';
echo '          <div id="extra" class="flex flex-row">';
echo '              <div title="Add priority" id="priorityButton" class="priorityMenu flex h-fit w-fit px-1 py-1 hover:bg-slate-200 rounded-lg cursor-pointer">';
echo '                  <svg class="flex w-4 h-4 fill-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M48 24C48 10.7 37.3 0 24 0S0 10.7 0 24V64 350.5 400v88c0 13.3 10.7 24 24 24s24-10.7 24-24V388l80.3-20.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30V66.1c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L48 52V24zm0 77.5l96.6-24.2c27-6.7 55.5-3.6 80.4 8.8c54.9 27.4 118.7 29.7 175 6.8V334.7l-24.4 9.1c-33.7 12.6-71.2 10.7-103.4-5.4c-48.2-24.1-103.3-30.1-155.6-17.1L48 338.5v-237z"/></svg>
                    </div>';
if ($priority !== "None") {
    echo '              <div id="priorityList" class="priorityMenu flex w-fit ml-2 h-fit rounded-lg border border-transparent ' . $priority_color . '">';
    echo '                  <div id="priorityListText" class="flex mx-auto px-2 cursor-pointer">' . $priority . '</div>';
    echo '              </div>';
} else {
    echo '              <div id="priorityList" class="priorityMenu flex w-fit ml-2 h-fit rounded-lg border border-transparent bg-transparent">';
    echo '                  <div id="priorityListText" class="flex mx-auto px-2 cursor-pointer"></div>';
    echo '              </div>';
}
echo '          </div>';
echo '      </div>';
echo '      <div class="flex flex-row gap-2 ml-auto mr-2">';
echo '          <div class="taskEditSaveBtn w-fit h-fit px-3 py-1 bg-slate-500 border border-slate-400 hover:bg-slate-600 rounded-lg cursor-pointer text-slate-50" data-data-id="' . $dataID . '" data-board-id="' . $boardID . '">Save</div>';
echo '      </div>';
echo '  </div>';
echo '</div>';
