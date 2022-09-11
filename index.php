<?php
session_start();
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
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />
</head>

<body class="flex w-screen h-screen flex-col" onload="resetStyling()">
    <?php
    echo '<div class="app_navbarContainer h-fit pb-2 pt-2 shadow-bottom shadow-lg flex w-screen relative">';
    echo '<nav class="app_mainNavContainer flex flex-grow mx-12 justify-between w-screen">';
    echo '<div class="app_mainNav flex flex-shrink my-auto gap-3 justify-start">';
    echo '<button id="opensidebar" title="Open/close - M" type="button" class="h-9 w-9 hover:bg-slate-100 transition ease-out duration-200 rounded-lg" onclick="expandSidebar()">';
    echo '<svg class="w-6 h-6 mx-auto fill-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">';
    echo '<path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z" />';
    echo '</svg>';
    echo '</button>';
    echo '</div>';
    echo '<div class="app_authNav flex flex-shrink my-auto gap-3 text-xl justify-end select-none">';
    if (!isset($_SESSION['login_user'])) {
        echo '<a href="auth/login.php" type="button" class="h-fit w-fit px-2 py-2 hover:bg-slate-100 transition ease-out duration-200 rounded-lg break-normal font-bold">Log in</a>';
        echo '<a href="auth/signup.php" type="button" class="h-fit w-fit px-2 py-2 min-w-16 bg-blue-500 hover:bg-blue-400 transition ease-out duration-200 rounded-lg break-normal font-bold text-white">Sign Up</a>';
    } else {
        echo '<div class="flex h-fit w-fit px-2 py-2 hover:bg-slate-100 transition ease-out duration-200 rounded-lg break-normal font-bold cursor-pointer" onclick="showProfileMenu()">';
        echo '' . $_SESSION['login_user'] . '';
        echo '</div>';
        echo '<ul id="profile_dropdown" class="absolute flex flex-col bg-slate-50 w-48 h-fit mt-[3.3rem] border border-gray-300 shadow-lg rounded-lg">';
        echo '<li class="flex text-gray-600 hover:bg-slate-200 mx-1 my-1 hover:rounded-lg cursor-pointer"><svg class="w-6 h-6 my-auto fill-gray-600 mr-2 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M495.9 166.6C499.2 175.2 496.4 184.9 489.6 191.2L446.3 230.6C447.4 238.9 448 247.4 448 256C448 264.6 447.4 273.1 446.3 281.4L489.6 320.8C496.4 327.1 499.2 336.8 495.9 345.4C491.5 357.3 486.2 368.8 480.2 379.7L475.5 387.8C468.9 398.8 461.5 409.2 453.4 419.1C447.4 426.2 437.7 428.7 428.9 425.9L373.2 408.1C359.8 418.4 344.1 427 329.2 433.6L316.7 490.7C314.7 499.7 307.7 506.1 298.5 508.5C284.7 510.8 270.5 512 255.1 512C241.5 512 227.3 510.8 213.5 508.5C204.3 506.1 197.3 499.7 195.3 490.7L182.8 433.6C167 427 152.2 418.4 138.8 408.1L83.14 425.9C74.3 428.7 64.55 426.2 58.63 419.1C50.52 409.2 43.12 398.8 36.52 387.8L31.84 379.7C25.77 368.8 20.49 357.3 16.06 345.4C12.82 336.8 15.55 327.1 22.41 320.8L65.67 281.4C64.57 273.1 64 264.6 64 256C64 247.4 64.57 238.9 65.67 230.6L22.41 191.2C15.55 184.9 12.82 175.3 16.06 166.6C20.49 154.7 25.78 143.2 31.84 132.3L36.51 124.2C43.12 113.2 50.52 102.8 58.63 92.95C64.55 85.8 74.3 83.32 83.14 86.14L138.8 103.9C152.2 93.56 167 84.96 182.8 78.43L195.3 21.33C197.3 12.25 204.3 5.04 213.5 3.51C227.3 1.201 241.5 0 256 0C270.5 0 284.7 1.201 298.5 3.51C307.7 5.04 314.7 12.25 316.7 21.33L329.2 78.43C344.1 84.96 359.8 93.56 373.2 103.9L428.9 86.14C437.7 83.32 447.4 85.8 453.4 92.95C461.5 102.8 468.9 113.2 475.5 124.2L480.2 132.3C486.2 143.2 491.5 154.7 495.9 166.6V166.6zM256 336C300.2 336 336 300.2 336 255.1C336 211.8 300.2 175.1 256 175.1C211.8 175.1 176 211.8 176 255.1C176 300.2 211.8 336 256 336z"/></svg>Settings</li>';
        echo '<li onclick="userLogOut()" class="flex text-gray-600 hover:bg-slate-200 mx-1 my-1 hover:rounded-lg cursor-pointer border-t border-gray-200"><svg class="w-6 h-6 my-auto fill-gray-600 mr-2 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M560 448H512V113.5c0-27.25-21.5-49.5-48-49.5L352 64.01V128h96V512h112c8.875 0 16-7.125 16-15.1v-31.1C576 455.1 568.9 448 560 448zM280.3 1.007l-192 49.75C73.1 54.51 64 67.76 64 82.88V448H16c-8.875 0-16 7.125-16 15.1v31.1C0 504.9 7.125 512 16 512H320V33.13C320 11.63 300.5-4.243 280.3 1.007zM232 288c-13.25 0-24-14.37-24-31.1c0-17.62 10.75-31.1 24-31.1S256 238.4 256 256C256 273.6 245.3 288 232 288z"/></svg>Log out</li>';
        echo '</ul>';
    }
    echo '</div>';
    echo '</nav>';
    echo '</div>';
    ?>
    <div class="app_appMain w-screen h-screen flex flex-row" onclick="closeProfileMenu()">
        <div class="app_appSidebarContainer flex flex-grow">
            <div id="sidebar" class="app_appSidebar flex bg-slate-100 expandSidebar border-2 border-slate-200">
                <div id="tabContainer" class="app_appTabContainer flex flex-col w-48 mx-auto">
                    <div class="app_appProjectTab flex mt-8 mb-4 h-8" onclick="showProjects()">
                        <button id="anglesymbol" type="button" class="h-8 w-full font-medium" onclick="rotateAngle('angle')"> <svg id="angle" class="h-4 w-4 ml-8 mt-1 absolute rotateAngleNormal" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                <path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z" />
                            </svg>Projects</button>
                    </div>
                    <ul id="projectList" class="flex flex-col gap-1 hidden">
                        <?php
                        $q = "select project.project_name, colors.color_name, colors.color_code from project join colors on project.colorID = colors.colorID where userID = '$userID'";
                        $result = mysqli_query($conn, $q);

                        if (mysqli_num_rows($result) > 0) {
                            while ($projects = mysqli_fetch_assoc($result)) {
                                echo '<li class="group flex w-full h-8 hover:bg-slate-200 cursor-pointer rounded-md">';
                                echo '<div id="' . $projects['color_name'] . '" class="flex w-4 h-4 my-auto ml-2 rounded-md z-4 ' . $projects['color_code'] . '" value="' . $projects['color_code'] . '"></div>';
                                echo '<div id="' . $projects['project_name'] . '_name" class="flex ml-3 my-auto select-none" value="' . $projects['project_name'] . '">' . $projects['project_name'] . '</div>';
                                echo '<textarea id="' . $projects['project_name'] . '_edit" type="text" class="form-control px-1 w-1/2 flex h-6 bg-slate-50 text-md resize-none ml-auto my-auto hidden overflow-auto rounded-md">' . $projects['project_name'] . '</textarea>';
                                //Buttons
                                echo '<div id="' . $projects['project_name'] . '" class="bs flex flex-row w-fit h-8 container ml-auto">';
                                //Edit project name button
                                echo '<button type="button" onclick="showProjectNameEdit()" title="Change project name" class="z-2 flex w-6 h-8 hover:bg-slate-300">';
                                echo '<svg class="flex w-3 h-3 mx-auto my-auto fill-slate-400 opacity-0 group-hover:opacity-100 group-hover:transition group-hover:duration-500 group-hover:ease-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></button>';
                                //Delete project
                                echo '<button type="button" onclick="deleteProject()" title="Delete this project" class="z-2 flex w-6 h-8 hover:bg-slate-300 rounded-tr-lg rounded-br-lg">';
                                echo '<svg class="flex w-3 h-3 mx-auto my-auto fill-slate-400 opacity-0 group-hover:opacity-100 group-hover:transition group-hover:duration-500 group-hover:ease-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg></button>';
                                echo '</div>';
                                // ------------------------------------------
                                echo '<div id="' . $projects['project_name'] . '_editcontrol" class="flex flex-row w-fit h-8 container ml-auto hidden">';
                                //Save changes
                                echo '<button type="button" onclick="saveChanges()" title="Save changes" class="z-2 flex w-6 h-8 hover:bg-slate-300">';
                                echo '<svg class="flex w-3 h-3 mx-auto my-auto fill-slate-400 opacity-0 group-hover:opacity-100 group-hover:transition group-hover:duration-500 group-hover:ease-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M470.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 338.7 425.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg></button>';
                                //Cancel changes
                                echo '<button type="button" onclick="cancelChanges()" title="Cancel changes" class="z-2 flex w-6 h-8 hover:bg-slate-300 rounded-tr-lg rounded-br-lg">';
                                echo '<svg class="flex w-3 h-3 mx-auto my-auto fill-slate-400 opacity-0 group-hover:opacity-100 group-hover:transition group-hover:duration-500 group-hover:ease-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></button>';
                                //End of buttons
                                echo '</div>';
                                echo '</li>';
                            }
                        }

                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="app_appProjectsContainer flex flex-col flex-grow w-screen bg-slate-50 pl-16">
            <div class="flex h-8 pt-16 w-full font-bold text-xl text-gray-500 bg-slate-50 select-none">
                YOUR PROJECTS
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6 mt-16 w-fit">
                <?php
                $q = "select project.project_name, colors.color_name, colors.color_code from project join colors on project.colorID = colors.colorID where userID = '$userID'";
                $result = mysqli_query($conn, $q);

                if (mysqli_num_rows($result) > 0) {
                    while ($projects = mysqli_fetch_assoc($result)) {
                        echo '<button type="button" class="flex flex-col w-40 h-20 rounded-lg bg-slate-200 hover:bg-slate-300">';
                        echo '<div class="flex h-5 w-full ' . $projects['color_code'] . ' rounded-tr-lg rounded-tl-lg"></div>';
                        echo '<div class="flex text-md ml-2 mt-2 text-gray-600 select-none" title=' . $projects['project_name'] . '><strong>' . $projects['project_name'] . '</strong></div>';
                        echo '</button>';
                    }
                }

                ?>
                <button type="button" class="flex justify-center w-40 h-20 rounded-lg bg-slate-200 hover:bg-slate-300" title="Create a new project - C" onclick="openProjectCreate()">
                    <div class="flex container mx-auto my-auto justify-center text-3xl text-gray-600 select-none">+</div>
                </button>
            </div>
        </div>
    </div>
    <div id="newProj" class="app_appNewProjectDialogBlur fixed w-screen h-screen flex beforeShowUp" style="background: rgba(255,255,255,0.8);">
        <div id="newProjDialog" class="app_appNewProjectDialogWindow flex flex-col w-96 max-w-full h-fit mx-auto mt-16 shadow-lg rounded-lg">
            <div id="title-background" class="app_appDialogTitle flex pl-6 py-2 bg-slate-100 w-full font-bold text-gray-500 rounded-t-lg border-b-2">
                New Project
            </div>
            <form class="app_appDialogForm flex flex-col w-full h-full bg-slate-50 rounded-b-lg" method="post">
                <div class="app_appFormField mt-4 px-6 flex flex-col gap-1">
                    <label for="nameInput" class="font-bold">Name</label>
                    <input type="text" id="nameInput" class="flex shadow-md form-control block w-full px-2 text-lg font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" autocomplete="none">
                </div>
                <div class="app_appFormField mt-4 px-6 flex flex-col gap-1">
                    <label for="colorChoose" class="font-bold">Color</label>
                    <button type="button" id="colorChoose" class="flex flex-col h-[1.7rem] border border-slate-200 bg-white">
                        <div class="currentColorBar flex flex-row w-full h-[1.7rem]" onclick="openColorSelectMenu()">
                            <div id="currentColor" class="flex w-4 h-4 mt-[0.3rem] ml-2 rounded-md bg-red-800"></div>
                            <div id="currentColorName" class="flex h-4 mt-[0.1rem] pl-3">Dark Red</div>
                            <div class="flex h-4 w-4 ml-auto my-auto mt-1 mr-2">
                                <svg id="angleColor" class="flex h-4 w-4 fill-black rotateAngleNormal" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                    <path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z" />
                                </svg>
                            </div>
                        </div>
                        <div id="colorSelect" class="app_colorChoose flex relative w-[21rem] h-fit bg-slate-100 mt-4">
                            <ul class="flex flex-col">
                                <?php
                                $q = "select color_name, color_code from colors";
                                $result = mysqli_query($conn, $q);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($options = mysqli_fetch_assoc($result)) {
                                        echo '<li id="' . $options['color_name'] . '" class="flex w-[21rem] h-8 hover:bg-slate-200" onclick="saveColor()">';
                                        echo '<div id="' . $options['color_name'] . '" class="flex w-4 h-4 my-auto ml-2 rounded-md ' . $options['color_code'] . '" value="' . $options['color_code'] . '"></div>';
                                        echo '<div id="' . $options['color_name'] . '" class="flex ml-3 my-auto" value="' . $options['color_name'] . '">' . $options['color_name'] . '</div>';
                                        echo '</li>';
                                    };
                                }
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
    </div>
    <script>
        function rotateAngle(angleName) {
            var angle = document.getElementById(angleName);
            if (angle.classList.contains("rotateAngleNormal")) {
                angle.classList.remove("rotateAngleNormal");
                angle.classList.add("rotateAngleDown");
            } else {
                angle.classList.remove("rotateAngleDown");
                angle.classList.add("rotateAngleNormal");
            }
        }

        function showProjectNameEdit() {
            var idOfClickedObject = event.currentTarget.parentElement.id;
            const allEditElements = document.querySelectorAll(`textarea[id$='_edit']`);
            const allNameElements = document.querySelectorAll(`div[id$='_name']`);
            const allEditControlElements = document.querySelectorAll("div[id$='_editcontrol']");
            const allBasicControlElements = document.querySelectorAll(`.bs`);
            
            allEditElements.forEach(element => {
                element.classList.add("hidden");
            }) 
            allNameElements.forEach(element => {
                element.classList.remove("hidden");
            })
            allBasicControlElements.forEach(element => {
                element.classList.remove("hidden");
            })
            allEditControlElements.forEach(element => {
                element.classList.add("hidden");
            })
            
            var oldname = document.getElementById(idOfClickedObject + "_name");
            var newname = document.getElementById(idOfClickedObject + "_edit");
            var control = document.getElementById(idOfClickedObject);
            var editcontrol = document.getElementById(idOfClickedObject + "_editcontrol");

            oldname.classList.toggle("hidden");
            newname.classList.toggle("hidden");
            editcontrol.classList.toggle("hidden");
            control.classList.toggle("hidden");
        }

        function cancelChanges() {
            var idOfClickedObject = event.currentTarget.parentElement.id;
            var editcontrol = document.getElementById(idOfClickedObject);
            var elementID = document.getElementById(idOfClickedObject.slice(0, idOfClickedObject.indexOf("_"))); //element ID
            var control = elementID 
            var oldname = document.getElementById(control.id + "_name");
            var newname = document.getElementById(control.id + "_edit");
            newname.value = control.id;

            editcontrol.classList.toggle("hidden");
            control.classList.toggle("hidden");
            newname.classList.toggle("hidden");
            oldname.classList.toggle("hidden");
            
        }

        function saveChanges() {
            var idOfClickedObject = event.currentTarget.parentElement.id;
            var elementID = document.getElementById(idOfClickedObject.slice(0, idOfClickedObject.indexOf("_"))); //element ID
            var getEditTextareaValue = document.getElementById(elementID.id + "_edit").value;
            $.post("./utils/scripts/saveProjectName.php", {
                oldName: elementID.id,
                newName: getEditTextareaValue
            }).done(function(data) {
                console.log(data);
                window.location.reload();
            })
        }


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

        window.onload = resetStyling;
    </script>
</body>

</html>