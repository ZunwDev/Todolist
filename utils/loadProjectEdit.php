<?php

include "./scripts/connectToDatabase.php";
include "./scripts/getUserID.php";
$projectID = $_POST['projectID'];

$q = "select project.project_name, project.project_description, colors.color_code, colors.color_name from project join colors on project.colorID = colors.colorID where project.projectID = $projectID";
$f = mysqli_fetch_assoc(mysqli_query($conn, $q));

echo '<div id="projectEditOverlay" class="w-screen h-screen absolute bg-slate-50/25">';
echo '  <div id="projectEditPopup" class="absolute flex left-0 right-0 ml-auto mr-auto beforeShowUp top-28 flex-col h-fit w-80 shadow-lg bg-slate-50 rounded-lg">';
echo '      <div class="deleteHeader flex flex-row w-full h-8 border-b border-slate-200 gap-4">';
echo '          <div class="my-1 ml-4 w-full h-full font-bold">Project edit</div>';
echo '          <div class="ml-auto mt-1 mr-1 flex h-fit w-fit px-1 py-1 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="cancelProjectEdit()"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>';
echo '      </div>';
echo '      <div class="flex flex-col space-y-2">';
echo '          <div class="wrap mt-4 w-full h-full px-6 space-y-1 flex flex-col">';
echo '              <label class="font-bold">Name</label>';
echo '              <input placeholder="Type a new project name" id="projectNameEdit" type="text" class="flex shadow-md form-control block w-full px-2 text-base font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none" value="' . $f['project_name'] . '"></input>';
echo '          </div>';
echo '          <div class="wrap mt-4 w-full h-full px-6 space-y-1 flex flex-col">';
echo '              <label class="font-bold">Description</label>';
echo '              <textarea id="projectDescriptionEdit" placeholder="Describe this project" maxlength="128" class="descriptionInput flex overflow-y-auto shadow-md h-20 form-control block w-full px-2 text-base font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none resize-none" autocomplete="none">' . $f['project_description'] . '</textarea>';
echo '          </div>';
echo '          <div class="wrap mt-4 w-full h-full px-6 space-y-1 flex flex-col">';
echo '              <label class="font-bold">Color</label>';
echo '              <div id="colorChoose" class="flex flex-col h-[1.7rem] border border-slate-200 bg-slate-50">';
echo '                  <div class="currentColorBar flex flex-row w-full h-[1.7rem] cursor-pointer" onclick="openColorSelectMenu()">';
echo '                      <div id="currentColor" class="flex w-4 h-4 mt-[0.3rem] ml-2 rounded-md ' . $f['color_code'] . '"></div>';
echo '                      <div id="currentColorName" class="flex h-4 mt-[0.1rem] pl-3">' . $f['color_name'] . '</div>';
echo '                      <div class="flex h-4 w-4 ml-auto my-auto mt-1 mr-2">';
echo '                          <svg id="angleColor" class="flex h-4 w-4 fill-black toggle-up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">';
echo '                              <path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z" />';
echo '                          </svg>';
echo '                      </div>';
echo '                  </div>';
echo '              <div id="colorSelect" class="flex flex-wrap mx-auto py-3 pl-[1.15rem] gap-2 relative w-fit h-0 opacity-0 duration-100 bg-slate-100 rounded-lg mt-4 transition-[height]" style="display: none">';
include "./loadColors.php";
echo '              </div>';
echo '          </div>';
echo '      </div>';
echo '      </div>';
echo '      <div class="flex flex-row w-full gap-3 mt-auto px-2 pb-2 pt-4">';
echo '          <div class="flex">';
echo '              <div title="Delete whole project" class="w-fit transition h-fit px-6 py-2.5 mr-auto bg-red-300 border border-red-600 hover:bg-red-500 rounded-lg cursor-pointer group" onclick="showProjectDeleteWarning(`' . $projectID . '`)"><svg class="w-3 h-3 fill-white transition-all" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></div>';
echo '          </div>';
echo '          <div class="flex flex-row gap-2 ml-auto">';
echo '              <div class="w-fit h-fit px-3 py-1 bg-slate-100 border border-slate-200 hover:bg-slate-300 rounded-lg cursor-pointer" onclick="cancelProjectEdit()">Cancel</div>';
echo '              <div class="w-fit h-fit px-3 py-1 bg-slate-500 border border-slate-400 hover:bg-slate-600 rounded-lg cursor-pointer text-slate-50" onclick="saveProjectChanges(`' . $projectID . '`)">Save</div>';
echo '          </div>';
echo '      </div>';
echo '  </div>';
echo '</div>';
