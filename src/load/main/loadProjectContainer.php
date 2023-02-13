<section class="app_appProjectsContainer flex flex-col w-full pl-64">
    <div class="project_wrapper px-16 overflow-y-auto py-16 flex-shrink-0">
        <div id="projects_nameEl" class="flex h-8 font-bold text-md text-gray-500 flex-shrink-0">
            YOUR PROJECTS
        </div>
        <div id="project_grid" class="flex flex-wrap gap-6 py-10 flex-shrink-0">
            <?php
            include "./src/load/project/loadProjects.php";
            ?>
        </div>
    </div>
</section>