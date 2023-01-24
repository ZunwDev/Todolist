<?php

include "../../scripts/db/connectToDatabase.php";
include "../../scripts/db/getUserID.php";

$projectID = $_POST['projectID'];
$dataID = $_POST['dataID'];

$q = "SELECT board_name, boardID FROM board WHERE projectID = '$projectID'";
$r = mysqli_query($conn, $q);

echo '<div id="popupPopupOverlay" class="w-screen h-screen absolute">';
echo '  <div id="popupPopupElement" class="absolute h-fit beforeShowUp flex flex-col flex-shrink-0 w-fit shadow-lg bg-slate-100 py-1">';
echo '      <div class="flex flex-col w-32">';
while ($boards = mysqli_fetch_assoc($r)) {
    //Start of list
    echo '<h3 class="text-sm truncate overflow-hidden!important bg-slate-100 py-2 hover:bg-slate-200 cursor-pointer pl-2" onclick="confirmMoving(' . $boards['boardID'] . ', ' . $dataID . ')">' . $boards['board_name'] . '</h3>';
    //End of list
}
echo '      </div>';
echo '  </div>';
echo '</div>';
