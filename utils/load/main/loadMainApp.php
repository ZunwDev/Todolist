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
                    include "./utils/load/other/loadSidebar.php";
                    ?>
                </ul>
            </div>
        </div>
    </section>