<?php
$q = "select project.project_description, project.projectID, project.project_name, colors.color_name, colors.color_code from project join colors on project.colorID = colors.colorID where userID = '$userID'";
$result = mysqli_query($conn, $q);

if (mysqli_num_rows($result) > 0) {
    while ($projects = mysqli_fetch_assoc($result)) {
        echo '<button type="button" class="flex group gap-2 flex-col w-52 h-fit shadow-xl relative transition rounded-lg bg-slate-100" onclick="openProject(`' . $projects['projectID'] . '`, `' . $projects['project_name'] . '`, `' . $projects['color_code'] . '`)">';
        echo '  <div class="flex h-1 transition-all duration-300 group-hover:h-full w-full absolute ' . $projects['color_code'] . ' group-hover:rounded-lg rounded-tr-lg rounded-tl-lg"></div>';
        echo '  <div class="flex flex-col text-lg group-hover:z-10 group-hover:text-white transition mt-2 px-4 h-fit w-fit text-gray-600 select-none" title=' . $projects['project_name'] . '><strong>' . $projects['project_name'] . '</strong>';
        echo '      <div class="flex w-0 h-0.5 delay-100 transition-all group-hover:z-10 bg-white group-hover:w-full"></div>';
        echo '  </div>';
        if (strlen($projects['project_description']) > 0) {
            echo '<div class="flex w-52 mx-auto group-hover:z-10 group-hover:text-gray-300 transition text-xs text-gray-500 px-4 pb-8 rounded-lg break-words text-left resize-none overflow-y-hidden" title="' . $projects['project_description'] . '">' . $projects['project_description'] . '</div>';
        } else {
            echo '<div class="flex w-full text-sm rounded-lg text-gray-400"></div>';
        }
        echo '<div class="flex relative w-full h-8 overflow-hidden">';
        $getFillColor = substr($projects['color_code'], 3);
        echo '  <div title="Open project" class="flex h-8 w-8 right-full group-hover:transition-[right] group-hover:right-0 delay-200 rounded-full absolute group-hover:rounded-tl-full group-hover:rounded-none opacity-0 group-hover:z-10 opacity-0 transition-all delay-200 group-hover:opacity-100 bg-white"><svg class="flex h-4 w-4 ml-auto mt-auto mr-1 mb-1 fill-' . $getFillColor . ' group-hover:z-10 opacity-0 transition-all delay-300 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg></div>';
        echo '</div>';
        echo '</button>';
    }
}
echo '<button type="button" class="flex justify-center w-40 h-20 rounded-lg transition ease-in-out duration-200 bg-slate-200 hover:bg-slate-300" title="Create a new project" onclick="openProjectCreate()">';
echo '  <div class="flex container mx-auto my-auto justify-center text-3xl text-gray-600 select-none">+</div>';
echo '</button>';
