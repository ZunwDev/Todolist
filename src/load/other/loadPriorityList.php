<?php

include "../../scripts/db/connectToDatabase.php";

$q = "select priority_name from priority";
$result = mysqli_query($conn, $q);

echo '<div id="popupOverlayPriority" class="w-screen z-50 h-screen absolute">';
echo '  <div id="popupElementPriority" class="absolute h-fit beforeShowUp flex flex-col border border-slate-300 flex-shrink-0 w-fit shadow-lg bg-slate-50 py-1">';
echo '      <div class="flex flex-col w-32">';
while ($priorities = mysqli_fetch_assoc($result)) {
    //Start of list
    echo '<div class="prioritySaveBtn flex pl-2 py-1 text-sm bg-slate-50 hover:bg-slate-200 cursor-pointer" data-priority-name="' . $priorities['priority_name'] . '">' . $priorities['priority_name'] . '</div>';
    //End of list
}
echo '      </div>';
echo '  </div>';
echo '</div>';
