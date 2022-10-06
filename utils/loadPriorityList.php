<?php

include "./scripts/connectToDatabase.php";

$q = "select priority_name from priority";
$result = mysqli_query($conn, $q);

echo '<div id="priorityListOverlay" class="w-screen h-screen absolute bg-white/25">';
echo '  <div id="priorityListPopup" class="absolute h-fit beforeShowUp flex flex-col flex-shrink-0 w-fit shadow-lg bg-slate-100 pb-2 rounded-lg">';
echo '      <div class="flex w-full bg-slate-100 h-fit rounded-tr-lg rounded-tl-lg">';
echo '          <div class="flex h-fit flex-row my-1 gap-3 mx-2">';
echo '          <div class="h-fit my-1">Priority</div>';
echo '          <div class="flex w-full my-1 h-fit">';
echo '          <div title="Close priority list" class="flex h-fit w-fit px-2 py-2 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="closePriorityList()"><svg class="flex w-3 h-3 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z"/></svg></div>';
echo '      </div>';
echo '  </div>';
echo '  </div>';
echo '  <div class="flex w-2/3 mx-auto h-0.5 bg-slate-200"></div>';
echo '      <div class="flex flex-col mt-2">';
                while ($priorities = mysqli_fetch_assoc($result)) {
                //Start of list
                echo '<div class="flex pl-2 py-1 mx-2 text-sm bg-slate-100 hover:bg-slate-200 cursor-pointer rounded-md" onclick="savePriority(`'.$priorities['priority_name'].'`)">'.$priorities['priority_name'].'</div>';
                //End of list
}
echo '          <div class="flex pl-2 py-1 text-sm mx-2 bg-slate-100 hover:bg-slate-200 cursor-pointer rounded-md" onclick="savePriority(`None`)">None</div>';
echo '      </div>';
echo '  </div>';
echo '</div>';