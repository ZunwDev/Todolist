<?php
include '../TodoList/utils/scripts/connectToDatabase.php';
include "../TodoList/utils/scripts/getUserID.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" name="TodoList Test Application" content="Learning new stuff">
    <title>TodoList</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK REL=StyleSheet HREF="stylesheet.css" TYPE="text/css" MEDIA=screen>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="./utils/main_page_setup.js"></script>
    <script src="./utils/color_menu_utils.js"></script>
    <script src="./utils/profile_utils.js"></script>
    <script src="./utils/project_utils.js"></script>
    <script src="./utils/sidebar_utils.js"></script>
    <script src="./utils/board_utils.js"></script>
    <script src="./utils/getDbData.js"></script>
    <script src="./utils/class/Color.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body id="body" class="flex w-screen h-screen flex-col">
    <?php
    include "./utils/loadNavbar.php";
    ?>
    <section class="app_appMain w-screen h-screen flex flex-row overflow-hidden relative bg-slate-100">
        <section class="app_appSidebarContainer flex absolute h-full">
            <div id="sidebar" class="expandSidebar app_appSidebar flex border-slate-200 bg-slate-100">
                <div id="tabContainer" class="app_appTabContainer flex flex-col w-48 mx-auto">
                    <div class="app_appProjectTab flex mt-8 mb-4 transition ease-in-out duration-200 h-8 hover:bg-slate-200 rounded-lg" onclick="showProjects()">
                        <button id="anglesymbol" type="button" class="h-8 w-full font-medium" onclick="toggleAngle()"> <svg class="angle h-4 w-4 ml-8 mt-1 absolute toggle-up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                <path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z" />
                            </svg>Projects</button>
                    </div>
                    <ul id="projectList" class="flex flex-col gap-1 hidden">
                        <?php
                        include "./utils/loadSidebar.php";
                        ?>
                    </ul>
                </div>
            </div>
        </section>
        <section class="app_appProjectsContainer flex flex-col bg-slate-50 w-full flex-shrink pl-64">
            <div class="project_wrapper pl-16 overflow-y-auto py-16">
                <div id="projects_nameEl" class="flex h-8 w-fit font-bold text-xl text-gray-500 bg-slate-50 select-none">
                    YOUR PROJECTS
                </div>
                <div id="project_grid" class="flex flex-wrap gap-6 pt-16 w-3/4">
                    <?php
                    include "./utils/loadProjects.php";
                    ?>
                </div>
            </div>
        </section>
    </section>
    <script>
        $(document).keyup(function(e) {
            if (e.key === "Escape") {
                var allEditElements = document.querySelectorAll(`textarea[id$='_edit']`);
                if (checkDisplay("#newProj")) {
                    if (checkDisplayFlex("#colorSelect")) {
                        openColorSelectMenu();
                    } else {
                        closeProjectCreate();
                    }
                }
                if (allEditElements.length > 0) {
                    sidebarDefault();
                }
            }
        })

        document.onkeypress = function(e) {
            e = e || window.event;
            var charCode = e.charCode || e.keyCode,
                character = String.fromCharCode(charCode);
            if (e.keyCode == 13) {
                var newProj = document.getElementById("newProj");
                var input = document.getElementById("nameInput");
                if (newProj.style.display === "block") {
                    if (input === document.activeElement) {
                        return true
                    } else {
                        acceptProjectCreate();
                    }
                };
            }
        }
    </script>
</body>

</html>