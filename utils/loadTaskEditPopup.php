<?php

include "../utils/scripts/connectToDatabase.php";
include "../utils/scripts/getUserID.php";

$dataID = $_POST['dataID'];
$projectName = $_POST['projectName'];

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

echo '<div id="taskEditOverlay" class="w-screen h-screen absolute bg-slate-50/25">';
echo '  <div id="taskEditPopup" class="absolute flex left-1/2 beforeShowUp top-28 flex-col h-fit w-[512px] shadow-lg bg-slate-50 pb-2 rounded-lg">';
echo '      <div class="editHeader flex flex-row w-full h-8 border-b border-slate-200 gap-4">';
echo '          <div class="my-1 ml-4 w-full h-full font-bold">Task edit</div>';
echo '              <div class="ml-auto mt-1 mr-1 flex h-fit w-fit px-1 py-1 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="cancelTaskEdit()"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>';
echo '          </div>';
echo '      <div class="wrap mt-4 w-full h-full px-6 space-y-2 flex flex-col">';
echo '          <input id="taskNameEdit" type="text" class="flex shadow-md form-control block w-full px-2 text-base font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none" value="' . $task_name . '"></input>';
echo '          <textarea id="taskDescriptionEdit" placeholder="In-depth description..." maxlength="128" class="descriptionInput flex shadow-md h-20 form-control block w-full px-2 text-base font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none resize-none overflow-y-hidden" autocomplete="none">' . $task_description . '</textarea>';
if ($dueTo !== "0000-00-00") {
    echo '          <input id="taskDueToEdit" class="dueTo flex w-full rounded-lg shadow-md border border-solid border-slate-300 form-control px-4 bg-slate-50 text-slate-700 border-b border-slate-300 focus:bg-slate-50 focus:border focus:outline-none focus:border-slate-600" type="date" value="' . $dueTo . '"></input>';
} else {
    echo '          <input id="taskDueToEdit" class="dueTo flex w-full rounded-lg shadow-md border border-solid border-slate-300 form-control px-4 bg-slate-50 text-slate-700 border-b border-slate-300 focus:bg-slate-50 focus:border focus:outline-none focus:border-slate-600" type="date"></input>';
}
echo '          <div id="extra" class="flex flex-row">';
echo '              <div title="Add priority" id="priorityButton" class="flex h-fit w-fit px-1 py-1 hover:bg-slate-200 rounded-lg cursor-pointer" onclick="showPriorityList()">';
echo '                  <svg class="flex w-4 h-4 fill-black"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 64c0-17.7-14.3-32-32-32S32 46.3 32 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM64 480c22.1 0 40-17.9 40-40s-17.9-40-40-40s-40 17.9-40 40s17.9 40 40 40z"/></svg>';
echo '              </div>';
if ($priority !== "None") {
    echo '              <div id="priorityList" class="flex w-fit ml-2 h-fit rounded-lg border border-transparent ' . $priority_color . '" onclick="showPriorityList()">';
    echo '                  <div id="priorityListText" class="flex mx-auto px-2 cursor-pointer">' . $priority . '</div>';
    echo '              </div>';
} else {
    echo '              <div id="priorityList" class="flex w-fit ml-2 h-fit rounded-lg border border-transparent bg-transparent" onclick="showPriorityList()">';
    echo '                  <div id="priorityListText" class="flex mx-auto px-2 cursor-pointer"></div>';
    echo '              </div>';
}
echo '          </div>';
echo '      </div>';
echo '      <div class="flex flex-row gap-2 ml-auto mr-2">';
echo '          <div class="w-fit h-fit px-3 py-1 bg-slate-100 border border-slate-200 hover:bg-slate-300 rounded-lg cursor-pointer" onclick="cancelTaskEdit()">Cancel</div>';
echo '          <div class="w-fit h-fit px-3 py-1 bg-slate-500 border border-slate-400 hover:bg-slate-600 rounded-lg cursor-pointer text-slate-50" onclick="saveTaskEdit(`'.$dataID.'`, `'.$projectName.'`, `'.$boardID.'`)">Save</div>';
echo '      </div>';
echo '  </div>';
echo '</div>';
