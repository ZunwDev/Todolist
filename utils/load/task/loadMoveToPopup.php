<?php

include "../../scripts/db/connectToDatabase.php";
include "../../scripts/db/getUserID.php";

$projectID = $_POST['projectID'];
$dataID = $_POST['dataID'];

$q = "SELECT board_name, boardID FROM board WHERE projectID = '$projectID'";
$r = mysqli_query($conn, $q);

echo '<div id="popupPopupOverlay" class="w-screen h-screen absolute bg-slate-50/25">';
echo '  <div id="popupPopupElement" class="absolute h-fit beforeShowUp flex flex-col flex-shrink-0 w-fit shadow-lg bg-slate-100 py-1">';
echo '      <div class="flex flex-col w-32">';
while ($boards = mysqli_fetch_assoc($r)) {
    //Start of list
    echo '<div class="flex pl-2 text-sm bg-slate-100 py-2 hover:bg-slate-200 cursor-pointer" onclick="confirmMoving(' . $boards['boardID'] . ', ' . $dataID . ')">' . $boards['board_name'] . '</div>';
    //End of list
}
echo '      </div>';
echo '  </div>';
echo '</div>';