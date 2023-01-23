<?php

include "../../scripts/db/connectToDatabase.php";

$projectID = $_POST['projectID'];

echo '<div id="popupOverlayFilter" class="w-screen h-screen absolute bg-slate-50/25">';
echo '  <div id="popupElement" class="absolute flex beforeShowUp flex-col h-fit w-56 pb-4 shadow-lg bg-slate-50 rounded-lg">';
echo '      <div class="filterHeader flex flex-row w-full h-8 border-b border-slate-200 gap-4">';
echo '          <div class="my-1 ml-4 w-full h-full font-bold">Filter</div>';
echo '          <div class="ml-auto mt-1 mr-1 flex h-fit w-fit px-1 py-1 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="closeFilter('.$projectID.')"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>';
echo '      </div>';
echo '      <div class="flex flex-col">';
echo '          <div class="wrap mt-4 w-full h-full px-4 space-y-1 flex flex-col">';
echo '              <label class="text-xs font-bold">Priority</label>';
echo '              <div class="flex flex-col gap-2">';
$options = ["High", "Medium", "Low", "None"];
for ($i=0; $i < count($options); $i++) {
    echo '                  <div class="px-4 flex">';
    echo '                      <input id="' . strtolower($options[$i]) . '_priFil" type="checkbox" class="w-4 h-4 my-auto cursor-pointer"></input>';
    echo '                      <label for="' . strtolower($options[$i]) . '_priFil" class="rounded-lg w-32 flex flex-row px-2 mx-auto cursor-pointer hover:bg-gray-200">';
    echo '                          <div class="text-sm">' . $options[$i] . '</div>';
    echo '                      </label>';
    echo '                  </div>';
}
echo '      </div>';
echo '</div>';
echo '          <div class="wrap mt-4 w-full h-full px-4 space-y-1 flex flex-col">';
echo '              <label class="text-xs font-bold">Term</label>';
echo '              <div class="flex flex-col gap-2">';
$options = ["Today", "Tomorrow", "Late", "Later", "No term"];
for ($i = 0; $i < count($options); $i++) {
    echo '                  <div class="px-4 flex">';
    echo '                      <input id="' . strtolower($options[$i]) . '_termFil" type="checkbox" class="w-4 h-4 my-auto cursor-pointer"></input>';
    echo '                      <label for="' . strtolower($options[$i]) . '_termFil" class="rounded-lg z-20 w-32 flex flex-row px-2 mx-auto cursor-pointer hover:bg-gray-200">';
    echo '                          <div class="text-sm">' . $options[$i] . '</div>';
    echo '                      </label>';
    echo '                  </div>';
}
echo '              </div>';
echo '          </div>';
echo '          <div class="wrap mt-4 w-full h-full px-4 space-y-1 flex flex-col">';
echo '              <label class="text-xs font-bold">Tasks</label>';
echo '              <div class="flex flex-col gap-2">';
$options = ["Completed", "Incomplete"];
for ($i = 0; $i < count($options); $i++) {
    echo '                  <div class="px-4 flex">';
    echo '                      <input id="' . strtolower($options[$i]) . '_taskFil" type="checkbox" class="w-4 h-4 my-auto cursor-pointer"></input>';
    echo '                      <label for="' . strtolower($options[$i]) . '_taskFil" class="rounded-lg z-20 w-32 flex flex-row px-2 mx-auto cursor-pointer hover:bg-gray-200">';
    echo '                          <div class="text-sm">' . $options[$i] . '</div>';
    echo '                      </label>';
    echo '                  </div>';
}
echo '              </div>';
echo '          </div>';
echo '      </div>';
echo '</div>';
echo '  </div>';
echo '</div>';
