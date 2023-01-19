<?php
include "../TodoList/utils/scripts/db/connectToDatabase.php";
$q = "select project.project_name, project.projectID, project.project_description, colors.color_name, colors.color_code from project join colors on project.colorID = colors.colorID where userID = '$userID'";
$result = mysqli_query($conn, $q);

if (mysqli_num_rows($result) > 0) {
    while ($projects = mysqli_fetch_assoc($result)) {
        echo '<li class="group flex w-full h-8 transition ease-in-out duration-200 hover:bg-white/70 rounded-md cursor-pointer" onclick="openProject(`' . $projects['projectID'] . '`)">';
        echo '<div class="flex w-3 h-3 my-auto ml-2 flex-shrink-0 rounded-full ' . $projects['color_code'] . '"></div>';
        echo '<div id="' . $projects['project_name'] . '_projectName" class="truncate pl-3 w-fit text-sm my-auto">' . $projects['project_name'] . '</div>';
        echo '<div class="flex my-auto ml-auto mr-2"><svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg></div>';
        echo '</li>';
    }
} else {
    echo '<button type="button" class="flex justify-center w-full my-auto h-8 rounded-lg transition ease-in-out duration-200 bg-slate-200 hover:bg-slate-300 text-2xl" title="Create a new project" onclick="openProjectCreate()">+</button>';
}
