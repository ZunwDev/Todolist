<?php

include "../../scripts/db/connectToDatabase.php";
include "../../scripts/db/getUserID.php";

$projectID = $_POST['projectID'];
$dataID = $_POST['dataID'];

$q = "SELECT board_name, boardID FROM board WHERE projectID = '$projectID'";
$r = mysqli_query($conn, $q);

echo '<div id="popupPopupOverlay" class="w-screen h-screen z-50 absolute">';
echo '  <div id="popupPopupElement" class="absolute h-fit beforeShowUp flex flex-col border border-slate-300 flex-shrink-0 w-fit shadow-lg bg-slate-50 py-1">';
echo '      <div class="flex flex-col w-32 max-h-48 overflow-y-auto flex-shrink-0">';
while ($boards = mysqli_fetch_assoc($r)) {
    //Start of list
    echo '<h3 class="confirmTaskMove text-sm flex-shrink-0 truncate overflow-hidden!important bg-slate-50 py-1 hover:bg-slate-200 cursor-pointer pl-2" data-board-id="' . $boards['boardID'] . '" data-data-id="' . $dataID . '">' . $boards['board_name'] . '</h3>';
    //End of list
}
echo '      </div>';
echo '  </div>';
echo '</div>';
