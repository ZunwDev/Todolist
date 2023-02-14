<?php

$id = $_POST['id'];
$title  = $_POST['title'];
$msg = $_POST['msg'];
$reason = $_POST['reason'];

echo '<div id="popupOverlay" class="flex w-screen h-screen z-50 absolute bg-white/25">';
echo ' <div id="popupElement" class="flex flex-col w-80 h-fit top-28 bg-slate-50 shadow-xl absolute border border-slate-300 left-0 right-0 ml-auto mr-auto rounded-lg">';
echo '  <div class="deleteHeader flex flex-row w-full h-8 border-b border-slate-200 gap-4">';
echo '    <div class="my-1 ml-4 w-full h-full font-bold">' . $title . '</div>';
echo '    <div class="ml-auto mt-1 mr-1 flex h-fit w-fit px-1 py-1 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="closeAnyPopup()"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>';
echo '  </div>';
echo '  <div class="w-full py-2 px-4 h-fit text-sm">' . $msg . '</div>';
echo '  <div class="flex py-2 w-full mt-4 bg-slate-100">';
echo '  <div class="flex flex-row gap-2 ml-auto mr-2">';
echo '    <div class="flex w-fit h-fit px-3 py-1 bg-slate-500 border border-slate-400 hover:bg-slate-600 rounded-lg cursor-pointer text-slate-50" onclick="confirmDelete(`' . $id . '`, `' . $reason . '`)">Delete</div>';
echo '  </div>';
echo '</div>';
echo '</div>';
echo '</div>';
