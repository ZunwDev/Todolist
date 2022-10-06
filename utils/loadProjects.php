<?php
$q = "select project.project_description, project.projectID, project.project_name, colors.color_name, colors.color_code from project join colors on project.colorID = colors.colorID where userID = '$userID'";
$result = mysqli_query($conn, $q);

if (mysqli_num_rows($result) > 0) {
    while ($projects = mysqli_fetch_assoc($result)) {
        echo '<button type="button" class="flex group flex-col w-52 h-fit shadow-xl relative rounded-lg bg-slate-100" onclick="openProject(`'.$projects['projectID'].'`, `'.$projects['project_name'].'`, `'.$projects['project_description'].'`, `'.$projects['color_code'].'`)">';
        echo '  <div class="flex h-1 group-hover:transition-[height] group-hover:duration-200 group-hover:rounded-bl-lg group-hover:rounded-br-lg group-hover:ease-in-out group-hover:shadow-xl w-full absolute group-hover:h-full ' . $projects['color_code'] . ' rounded-tr-lg rounded-tl-lg"></div>';
        echo '  <div class="flex text-lg w-full group-hover:z-10 group-hover:text-white transition px-4 mt-2 h-[3.2rem] text-gray-600 select-none" title=' . $projects['project_name'] . '><strong>' . $projects['project_name'] . '</strong></div>';
                if (strlen($projects['project_description']) > 0) {
                echo '<div class="flex w-52 mx-auto group-hover:z-10 group-hover:text-gray-300 transition text-xs text-gray-500 px-4 pb-8 rounded-lg break-words text-left resize-none overflow-y-hidden" title="' . $projects['project_description'] . '">' . $projects['project_description'] . '</div>';
                } else {
                    echo '<div class="flex w-full text-sm rounded-lg text-gray-400"></div>';
                }
        echo '</button>';
    }
}
