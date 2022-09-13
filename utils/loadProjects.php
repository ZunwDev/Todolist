<?php
$q = "select project.projectID, project.project_name, colors.color_name, colors.color_code from project join colors on project.colorID = colors.colorID where userID = '$userID'";
$result = mysqli_query($conn, $q);

if (mysqli_num_rows($result) > 0) {
    while ($projects = mysqli_fetch_assoc($result)) {
        echo '<button type="button" id="'. $projects['projectID'].'" class="flex flex-col w-40 h-20 rounded-lg bg-slate-200 hover:bg-slate-300" onclick="openProject()">';
        echo '<div class="flex h-5 w-full ' . $projects['color_code'] . ' rounded-tr-lg rounded-tl-lg"></div>';
        echo '<div class="flex text-md ml-2 mt-2 text-gray-600 select-none" title=' . $projects['project_name'] . '><strong>' . $projects['project_name'] . '</strong></div>';
        echo '</button>';
    }
}
