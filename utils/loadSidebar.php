<?php
include "../TodoList/utils/scripts/connectToDatabase.php";
$q = "select project.project_name, project.projectID, project.project_description, colors.color_name, colors.color_code from project join colors on project.colorID = colors.colorID where userID = '$userID'";
$result = mysqli_query($conn, $q);

if (mysqli_num_rows($result) > 0) {
    while ($projects = mysqli_fetch_assoc($result)) {
        echo '<li class="group flex w-full h-8 transition ease-in-out duration-200 hover:bg-slate-200 rounded-md">';
        echo '<div id="'.$projects['project_name'].'_link" class="absolute cursor-pointer z-10 h-8 w-full" onclick="openProjectSidebar(`'.$projects['projectID'].'`, `' . $projects['color_code'] . '`, `' . $projects['project_name'] . '`)"></div>';
        echo '<div class="flex w-4 h-4 my-auto ml-2 flex-shrink-0 rounded-md z-10 ' . $projects['color_code'] . '"></div>';
        echo '<div id="' . $projects['project_name'] . '_projectName" class="truncate pl-3 w-fit my-auto">' . $projects['project_name'] . '</div>';
        echo '</li>';
    }
} else {
    echo "No projects yet";
}
