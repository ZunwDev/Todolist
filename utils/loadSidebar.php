<?php
include "../TodoList/utils/scripts/connectToDatabase.php";
$q = "select project.project_name, project.projectID, project.project_description, colors.color_name, colors.color_code from project join colors on project.colorID = colors.colorID where userID = '$userID'";
$result = mysqli_query($conn, $q);

if (mysqli_num_rows($result) > 0) {
    while ($projects = mysqli_fetch_assoc($result)) {
        echo '<li class="group flex w-full h-8 transition ease-in-out duration-200 hover:bg-slate-200 rounded-md">';
        echo '<a id="'.$projects['project_name'].'_link" class="absolute cursor-pointer z-10 h-8 w-[8.5rem]" onclick="openProjectSidebar(`'.$projects['projectID'].'`, `'.$projects['project_name'].'`, `'.$projects['project_description'].'`, `'.$projects['color_code'].'`)"></a>';
        echo '<div class="flex w-4 h-4 my-auto ml-2 rounded-md z-10 ' . $projects['color_code'] . '"></div>';
        echo '<div id="' . $projects['project_name'] . '_projectName" class="flex ml-3 my-auto select-none">' . $projects['project_name'] . '</div>';
        echo '<textarea id="' . $projects['project_name'] . '_edit" type="text" class="form-control px-1 w-1/2 flex h-6 text-md resize-none ml-auto my-auto hidden overflow-auto rounded-md transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-blue-600">' . $projects['project_name'] . '</textarea>';
        //Buttons
        echo '<div id="' . $projects['project_name'] . '" class="bs flex flex-row w-fit h-8 container ml-auto">';
        //Edit project name button
        echo '<button type="button" onclick="showProjectNameEdit()" title="Change project name" class="z-10 flex w-6 h-8 hover:bg-slate-300">';
        echo '<svg class="flex w-3 h-3 mx-auto my-auto fill-slate-400 opacity-0 group-hover:opacity-100 group-hover:transition group-hover:duration-500 group-hover:ease-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></button>';
        //Delete project
        echo '<button type="button" onclick="deleteProject()" title="Delete this project" class="z-10 flex w-6 h-8 hover:bg-slate-300 rounded-tr-lg rounded-br-lg">';
        echo '<svg class="flex w-3 h-3 mx-auto my-auto fill-slate-400 opacity-0 group-hover:opacity-100 group-hover:transition group-hover:duration-500 group-hover:ease-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg></button>';
        echo '</div>';
        // ------------------------------------------
        echo '<div id="' . $projects['project_name'] . '_editcontrol" class="flex flex-row w-fit h-8 container ml-auto hidden">';
        //Save changes
        echo '<button type="button" onclick="saveChanges()" title="Save changes" class="z-10 flex w-6 h-8 hover:bg-green-200">';
        echo '<svg class="flex w-3 h-3 mx-auto my-auto fill-slate-400 opacity-0 group-hover:opacity-100 group-hover:transition group-hover:duration-500 group-hover:ease-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M470.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 338.7 425.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg></button>';
        //Cancel changes
        echo '<button type="button" onclick="cancelChanges()" title="Cancel changes - Esc" class="z-10 flex w-6 h-8 hover:bg-red-200 rounded-tr-lg rounded-br-lg">';
        echo '<svg class="flex w-3 h-3 mx-auto my-auto fill-slate-400 opacity-0 group-hover:opacity-100 group-hover:transition group-hover:duration-500 group-hover:ease-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></button>';
        //End of buttons
        echo '</div>';
        echo '</li>';
    }
} else {
    echo "No projects yet";
}
