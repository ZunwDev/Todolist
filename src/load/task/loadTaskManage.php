<?php

include "../../scripts/db/connectToDatabase.php";

$dataID = $_POST['dataID'];

$q = "SELECT board_check FROM board_data WHERE dataID = '$dataID'";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));

//Start of overlay
echo '<div id="popupOverlay" class="w-screen h-screen absolute">';
echo '    <div id="popupElement" class="absolute flex beforeShowUp flex-col h-fit shadow-lg py-1 bg-slate-50 border border-slate-300">';
echo '    <div class="setCheckmark flex flex-row py-0.5 w-48 bg-slate-50 hover:bg-slate-100 cursor-pointer" data-data-id="' . $dataID . '">';
echo '        <svg class="my-auto ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M470.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 338.7 425.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>';
$msg = $f['board_check'] == 0 ? "Mark complete" : "Mark incomplete";
echo '            <div class="flex text-sm px-2 py-0.5">' . $msg . '</div>';
echo '        </div>';
echo '    <div class="taskEditBtn flex flex-row py-0.5 bg-slate-50 hover:bg-slate-100 cursor-pointer" data-data-id="' . $dataID . '">';
echo '        <svg class="my-auto ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>';
echo '            <div class="flex text-sm pl-2 py-0.5">Edit task</div>';
echo '        </div>';
echo '    <div class="moveTaskPopupBtn flex flex-row py-0.5 bg-slate-50 hover:bg-slate-100 cursor-pointer" data-data-id="' . $dataID . '" >';
echo '        <svg class="my-auto ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg>';
echo '            <div class="flex text-sm pl-2 py-0.5">Move task to</div>';
echo '        </div>';
echo '    <div title="Delete this task" class="taskDeleteBtn flex flex-row py-0.5 bg-slate-50 hover:bg-slate-100 transition cursor-pointer" data-data-id="' . $dataID . '">';
echo '        <svg class="my-auto ml-2 w-4 h-4 transition fill-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>';
echo '            <div class="flex text-sm pl-2 py-0.5 text-red-600">Delete task</div>';
echo '        </div>';
echo '    </div>';
echo '</div>';
