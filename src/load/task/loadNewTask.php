<?php

$boardID = $_POST['boardID'];
$taskCount = $_POST['taskCount'];

echo '<div id="board_' . $boardID . '_edit" class="flex flex-col edit gap-2 pb-2 w-full">';
echo '<div class="w-full h-fit mt-1 bg-slate-50 flex flex-col border border-slate-400 rounded-md overflow-hidden">';
echo '  <textarea placeholder="Task name" autofocus autoselect id="task_' . $boardID . '_edit" maxlength="64" class="flex mt-[0.2px] form-control h-8 resize-none bg-transparent overflow-y-hidden pt-1 pl-2 w-full focus:outline-none"></textarea>';
echo '  <input id="dueTo" class="flex w-full mt-0.5 mx-[0.1px] form-control px-4 bg-transparent focus:outline-none" type="date"></input>';
echo '  <div class="flex flex-row w-full h-8 gap-3 ml-2">';
echo '    <div title="Add priority" id="priorityButton" class="priorityMenu flex h-fit w-fit px-1 my-1 py-1 hover:bg-slate-300 rounded-lg cursor-pointer">';
echo '      <svg class="flex w-4 h-4 fill-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M48 24C48 10.7 37.3 0 24 0S0 10.7 0 24V64 350.5 400v88c0 13.3 10.7 24 24 24s24-10.7 24-24V388l80.3-20.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30V66.1c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L48 52V24zm0 77.5l96.6-24.2c27-6.7 55.5-3.6 80.4 8.8c54.9 27.4 118.7 29.7 175 6.8V334.7l-24.4 9.1c-33.7 12.6-71.2 10.7-103.4-5.4c-48.2-24.1-103.3-30.1-155.6-17.1L48 338.5v-237z"/></svg>';
echo '    </div>';
echo '    <div id="priorityList" class="priorityMenu flex w-fit my-auto h-fit rounded-lg border border-transparent bg-transparent">';
echo '      <div id="priorityListText" class="flex mx-auto px-2 text-xs cursor-pointer"></div>';
echo '    </div>';
echo '  </div>';
echo '  <div class="flex flex-row gap-2 ml-auto mb-2 mr-2">';
echo '    <div class="cancelTaskBtn flex h-fit w-fit py-1 px-2 bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer" data-board-id="' . $boardID . '">';
echo '      <div class="flex mx-auto my-auto">Cancel</div>';
echo '    </div>';
echo '    <div class="saveTaskBtn flex h-fit w-fit py-1 px-2 bg-lime-400 hover:bg-lime-500 rounded-md cursor-pointer" data-board-id="' . $boardID . '">';
echo '      <div class="flex mx-auto my-auto">Add</div>';
echo '    </div>';
echo '  </div>';
echo '</div>';
echo '</div>';
