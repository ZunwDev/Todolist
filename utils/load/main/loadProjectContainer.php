<section class="app_appProjectsContainer flex flex-col bg-slate-50 w-full flex-shrink pl-64">
    <div class="project_wrapper pl-16 overflow-y-auto py-16">
        <div id="projects_nameEl" class="flex h-8 w-fit font-bold text-xl text-gray-500 bg-slate-50 select-none">
            YOUR PROJECTS
        </div>
        <div id="project_grid" class="flex flex-wrap gap-6 pt-16 w-3/4">
            <?php
            include "./utils/load/project/loadProjects.php";
            ?>
        </div>
    </div>
</section>
</section>