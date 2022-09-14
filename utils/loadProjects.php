<?php
$q = "select project.project_description, project.projectID, project.project_name, colors.color_name, colors.color_code from project join colors on project.colorID = colors.colorID where userID = '$userID'";
$result = mysqli_query($conn, $q);

if (mysqli_num_rows($result) > 0) {
    while ($projects = mysqli_fetch_assoc($result)) {
        echo '<button type="button" id="' . $projects['projectID'] . '" class="flex flex-col w-40 h-fit rounded-lg bg-slate-200 hover:bg-slate-300" onclick="openProject()">';
        echo '<div class="flex h-5 w-full ' . $projects['color_code'] . ' rounded-tr-lg rounded-tl-lg"></div>';
        echo '<div class="flex text-xl ml-2 mt-2 h-[3.2rem] text-gray-600 select-none" title=' . $projects['project_name'] . '><strong>' . $projects['project_name'] . '</strong></div>';
        if (strlen($projects['project_description']) > 0) {
            echo '<div class="flex w-40 mx-auto text-xs text-gray-400 px-2 pb-2 rounded-lg break-words text-left resize-none overflow-y-hidden" title="' . $projects['project_description'] . '">' . $projects['project_description'] . '</div>';
        } else {
            echo '<div class="flex w-full text-sm rounded-lg text-gray-400"></div>';
        }
        echo '</button>';
    }
}
