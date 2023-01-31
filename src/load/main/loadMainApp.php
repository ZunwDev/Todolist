<section class="w-screen h-screen flex flex-row overflow-hidden relative bg-slate-100">
    <section class="flex absolute h-full">
        <div id="sidebar" class="expandSidebar flex flex-col border-slate-200 px-6 pt-6 bg-slate-100">
            <div class="flex text-xs h-fit w-full font-bold">Projects</div>
            <ul id="projectList" class="flex flex-col mt-3 gap-1">
                <?php
                include "./src/load/other/loadSidebar.php";
                ?>
            </ul>
        </div>
    </section>