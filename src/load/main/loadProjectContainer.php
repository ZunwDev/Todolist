<section class="app_appProjectsContainer flex flex-col bg-slate-50 w-full pl-64">
    <div class="project_wrapper pl-16 overflow-y-auto py-16">
        <div id="projects_nameEl" class="flex h-8 w-fit font-bold text-md text-gray-500 bg-slate-50">
            YOUR PROJECTS
        </div>
        <div id="project_grid" class="flex flex-wrap gap-6 pt-16 w-3/4">
            <?php
            include "./src/load/project/loadProjects.php";
            ?>
        </div>
    </div>
</section>