<?php

include "../../scripts/db/connectToDatabase.php";

$projectID = $_POST['projectID'];

echo '<div id="popupOverlay" class="w-screen h-screen absolute bg-slate-50/25">';
echo '  <div id="popupElement" class="absolute flex beforeShowUp flex-col h-fit w-56 pb-4 shadow-lg bg-slate-50 rounded-lg">';
echo '      <div class="filterHeader flex flex-row w-full h-8 border-b border-slate-200 gap-4">';
echo '          <div class="my-1 ml-4 w-full h-full font-bold">Filter</div>';
echo '          <div class="ml-auto mt-1 mr-1 flex h-fit w-fit px-1 py-1 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="closeAnyPopup()"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>';
echo '      </div>';
echo '      <div class="flex flex-col">';
echo '          <div class="wrap mt-4 w-full h-full px-4 space-y-1 flex flex-col">';
echo '              <label class="text-sm">Priority</label>';
echo '              <div class="flex flex-col gap-2">';
$q = "SELECT priority_name, priority_color FROM priority";
$res = mysqli_query($conn, $q);
while ($priorities = mysqli_fetch_assoc($res)) {
    echo '                  <div class="px-4 flex gap-2">';
    echo '                      <input id="' . strtolower($priorities['priority_name']) . '" type="checkbox" class="w-4 h-4 my-auto"></input>';
    echo '                      <label for="' . strtolower($priorities['priority_name']) . '" class="' . $priorities['priority_color'] . ' rounded-lg w-32 px-2 flex flex-row gap-2 mx-auto">';
    echo '                          <svg class="w-4 h-4 my-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M48 24C48 10.7 37.3 0 24 0S0 10.7 0 24V64 350.5 400v88c0 13.3 10.7 24 24 24s24-10.7 24-24V388l80.3-20.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30V66.1c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L48 52V24zm0 77.5l96.6-24.2c27-6.7 55.5-3.6 80.4 8.8c54.9 27.4 118.7 29.7 175 6.8V334.7l-24.4 9.1c-33.7 12.6-71.2 10.7-103.4-5.4c-48.2-24.1-103.3-30.1-155.6-17.1L48 338.5v-237z"/></svg>';
    echo '                          <div>' . $priorities['priority_name'] . '</div>';
    echo '                      </label>';
    echo '                  </div>';
}
echo '      </div>';
echo '</div>';
echo '          <div class="wrap mt-4 w-full h-full px-4 space-y-1 flex flex-col">';
echo '              <label class="text-sm">Term</label>';
echo '              <div class="flex flex-col gap-2">';
$options = ["Today", "Tomorrow", "Late", "Later"];
$colors = ["lime", "amber", "red", "slate"];
for ($i = 0; $i < count($options); $i++) {
    echo '                  <div class="px-4 flex gap-2">';
    echo '                      <input id="' . strtolower($options[$i]) . '" type="checkbox" class="w-4 h-4 my-auto"></input>';
    echo '                      <label for="' . strtolower($options[$i]) . '" class="bg-' . $colors[$i] . '-400 rounded-lg z-20 w-32 px-2 flex flex-row gap-2 mx-auto">';
    echo '                          <svg class="w-4 h-4 my-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M232 120C232 106.7 242.7 96 256 96C269.3 96 280 106.7 280 120V243.2L365.3 300C376.3 307.4 379.3 322.3 371.1 333.3C364.6 344.3 349.7 347.3 338.7 339.1L242.7 275.1C236 271.5 232 264 232 255.1L232 120zM256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0zM48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256z"/></svg>';
    echo '                          <div>' . $options[$i] . '</div>';
    echo '                      </label>';
    echo '                  </div>';
}
echo '              </div>';
echo '          </div>';
echo '      </div>';
echo '</div>';
echo '  </div>';
echo '</div>';
