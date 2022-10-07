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
    <script src="./utils/class/Color.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body id="body" class="flex w-screen h-screen flex-col" onload="resetStyling()">
    <?php
    include "./utils/loadNavbar.php";
    ?>
    <section class="app_appMain w-screen h-screen flex flex-row overflow-hidden relative bg-slate-100">
        <section class="app_appSidebarContainer flex flex-grow absolute h-full">
            <div id="sidebar" class="app_appSidebar flex bg-slate-100 expandSidebar border-slate-200">
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
                    <button type="button" class="flex justify-center w-40 h-20 rounded-lg transition ease-in-out duration-200 bg-slate-200 hover:bg-slate-300" title="Create a new project" onclick="openProjectCreate()">
                        <div class="flex container mx-auto my-auto justify-center text-3xl text-gray-600 select-none">+</div>
                    </button>
                </div>
            </div>
        </section>
    </section>
    <section id="newProj" class="app_appNewProjectDialogBlur fixed w-screen h-full flex beforeShowUp" style="background: rgba(255,255,255,0.6);">
        <div id="newProjDialog" class="app_appNewProjectDialogWindow flex z-30 flex-col w-96 max-w-full h-fit mx-auto mt-16 shadow-xl rounded-lg">
            <div id="title-background" class="app_appDialogTitle flex pl-6 py-2 bg-slate-100 w-full font-bold text-gray-500 rounded-t-lg border-b-2">
                New Project
            </div>
            <form class="app_appDialogForm flex flex-col w-full h-full bg-slate-50 rounded-b-lg" method="post">
                <div class="app_appFormField mt-4 px-6 flex flex-col gap-1">
                    <label for="nameInput" class="font-bold">Name</label>
                    <input placeholder="e.g Work, Bussiness" type="text" id="nameInput" class="flex shadow-md form-control block w-full px-2 text-lg font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none" autocomplete="none">
                </div>
                <div class="app_appFormField mt-4 px-6 flex flex-col gap-1">
                    <label for="descriptionInputLabel" class="font-bold">Description</label>
                    <textarea id="descriptionInput" maxlength="128" class="flex shadow-md h-[1.85rem] form-control block w-full px-2 text-lg font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none resize-none overflow-y-hidden" autocomplete="none"></textarea>
                </div>
                <div class="app_appFormField mt-4 px-6 flex flex-col gap-1">
                    <label for="colorChoose" class="font-bold">Color</label>
                    <div id="colorChoose" class="flex flex-col h-[1.7rem] border border-slate-200 bg-slate-50">
                        <div class="currentColorBar flex flex-row w-full h-[1.7rem] cursor-pointer" onclick="openColorSelectMenu()">
                            <div id="currentColor" class="flex w-4 h-4 mt-[0.3rem] ml-2 rounded-md bg-red-800"></div>
                            <div id="currentColorName" class="flex h-4 mt-[0.1rem] pl-3">Dark Red</div>
                            <div class="flex h-4 w-4 ml-auto my-auto mt-1 mr-2">
                                <svg id="angleColor" class="flex h-4 w-4 fill-black toggle-up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                    <path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z" />
                                </svg>
                            </div>
                        </div>
                        <div id="colorSelect" class="flex flex-wrap mx-auto py-3 px-3 gap-2 relative w-[21rem] h-0 opacity-0 duration-100 bg-slate-100 rounded-lg mt-4 transition-[height]">
                            <?php
                            include "./utils/loadColors.php";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="app_appFormControl flex flex-row gap-2 justify-end mr-2">
                    <button title="Cancel - Esc" type="button" class="app_appFormCancel mt-4 py-1 px-3 mb-3 bg-slate-200 rounded-lg border border-slate-300 hover:bg-slate-300 select-none" onclick="closeProjectCreate()">
                        Cancel
                    </button>
                    <button title="Accept - Enter" type="button" class="app_appFormAccept mt-4 py-1 px-3 mb-3 bg-slate-500 text-white rounded-lg border border-slate-400 hover:bg-slate-600 select-none" onclick="acceptProjectCreate()">
                        Accept
                    </button>
                </div>
            </form>
        </div>
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