<?php
include "../TodoList/utils/scripts/getUserID.php";
include '../TodoList/utils/scripts/connectToDatabase.php';
$userID = getUserIDFromUser();
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
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />
</head>

<body class="flex w-screen h-screen flex-col" onload="resetStyling()">
    <?php
    include "./utils/loadNavbar.php";
    ?>
    <section class="app_appMain w-screen h-screen flex flex-row" onclick="closeProfileMenu()">
        <section class="app_appSidebarContainer flex flex-grow">
            <div id="sidebar" class="app_appSidebar flex bg-slate-100 expandSidebar border-2 border-slate-200">
                <div id="tabContainer" class="app_appTabContainer flex flex-col w-48 mx-auto">
                    <div class="app_appProjectTab flex mt-8 mb-4 h-8" onclick="showProjects()">
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
        <section class="app_appProjectsContainer flex flex-col flex-grow w-screen bg-slate-50 pl-16">
            <div class="flex h-8 pt-16 w-full font-bold text-xl text-gray-500 bg-slate-50 select-none">
                YOUR PROJECTS
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6 mt-16 w-fit">
                <?php
                include "./utils/loadProjects.php";
                ?>
                <button type="button" class="flex justify-center w-40 h-20 rounded-lg bg-slate-200 hover:bg-slate-300" title="Create a new project - C" onclick="openProjectCreate()">
                    <div class="flex container mx-auto my-auto justify-center text-3xl text-gray-600 select-none">+</div>
                </button>
            </div>
        </section>
    </section>
    <section id="newProj" class="app_appNewProjectDialogBlur fixed w-screen h-screen flex beforeShowUp" style="background: rgba(255,255,255,0.8);">
        <div id="newProjDialog" class="app_appNewProjectDialogWindow flex flex-col w-96 max-w-full h-fit mx-auto mt-16 shadow-lg rounded-lg">
            <div id="title-background" class="app_appDialogTitle flex pl-6 py-2 bg-slate-100 w-full font-bold text-gray-500 rounded-t-lg border-b-2">
                New Project
            </div>
            <form class="app_appDialogForm flex flex-col w-full h-full bg-slate-50 rounded-b-lg" method="post">
                <div class="app_appFormField mt-4 px-6 flex flex-col gap-1">
                    <label for="nameInput" class="font-bold">Name</label>
                    <input placeholder="e.g Work, Bussiness" type="text" id="nameInput" class="flex shadow-md form-control block w-full px-2 text-lg font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" autocomplete="none">
                </div>
                <div class="app_appFormField mt-4 px-6 flex flex-col gap-1">
                    <label for="descriptionInputLabel" class="font-bold">Description</label>
                    <textarea id="descriptionInput" maxlength="128" class="flex shadow-md h-[2.87rem] form-control block w-full px-2 text-lg font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none resize-none overflow-y-hidden" autocomplete="none"></textarea>
                </div>
                <div class="app_appFormField mt-4 px-6 flex flex-col gap-1">
                    <label for="colorChoose" class="font-bold">Color</label>
                    <button type="button" id="colorChoose" class="flex flex-col h-[1.7rem] border border-slate-200 bg-white">
                        <div class="currentColorBar flex flex-row w-full h-[1.7rem]" onclick="openColorSelectMenu()">
                            <div id="currentColor" class="flex w-4 h-4 mt-[0.3rem] ml-2 rounded-md bg-red-800"></div>
                            <div id="currentColorName" class="flex h-4 mt-[0.1rem] pl-3">Dark Red</div>
                            <div class="flex h-4 w-4 ml-auto my-auto mt-1 mr-2">
                                <svg id="angleColor" class="flex h-4 w-4 fill-black toggle-up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                    <path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z" />
                                </svg>
                            </div>
                        </div>
                        <div id="colorSelect" class="app_colorChoose flex relative w-[21rem] h-fit bg-slate-100 mt-4">
                            <ul class="flex flex-col">
                                <?php
                                include "./utils/loadColors.php";
                                ?>
                            </ul>
                        </div>
                    </button>
                </div>
                <div class="app_appFormControl flex flex-row gap-2 justify-end mr-2">
                    <button title="Cancel - C" type="button" class="app_appFormCancel mt-4 py-1 px-3 mb-3 bg-slate-200 rounded-lg border border-slate-300 hover:bg-slate-300 select-none" onclick="closeProjectCreate()">
                        Cancel
                    </button>
                    <button title="Accept - A" type="button" class="app_appFormAccept mt-4 py-1 px-3 mb-3 bg-blue-500 text-white rounded-lg border border-blue-400 hover:bg-blue-600 select-none" onclick="acceptProjectCreate()">
                        Accept
                    </button>
                </div>
            </form>
        </div>
    </section>
    <script>
        document.onkeypress = function(e) {
            e = e || window.event;
            var charCode = e.charCode || e.keyCode,
                character = String.fromCharCode(charCode);

            if (character == 'm') {
                var newProj = document.getElementById("newProj");
                if (newProj.style.display === "block") {
                    return true
                } else {
                    expandSidebar();
                }
            }

            if (character == 'c') {
                var newProj = document.getElementById("newProj");
                var input = document.getElementById("nameInput");
                if (newProj.style.display === "none") {
                    openProjectCreate();
                } else {
                    if (input === document.activeElement) {
                        return true
                    } else {
                        closeProjectCreate();
                    }
                }
            }
            if (character == 'a') {
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

        $("#descriptionInput").on("input", function() {
            this.style.height = "48px";
            this.style.height = this.scrollHeight + "px";
        });
        $("descriptionInput").on("keypress", function() {
            this.style.height = this.scrollHeight + "px";
        });
    </script>
</body>

</html>