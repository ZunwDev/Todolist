<?php 

//Start of new board button
echo '<div class="newBoard flex flex-col flex-shrink-0 transition-[height] ease-in-out duration-200 h-8 w-64 mx-4 mt-4 rounded-lg">';
echo '<textarea id="newBoardInput" class="form-control rounded-tr-lg rounded-tl-lg pl-2 pt-1 h-8 transition ease-in-out duration-200 overflow-y-hidden bg-transparent hover:bg-slate-200 truncate focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600 hidden resize-none">Column</textarea>';
echo '<div class="w-full flex flex-row mt-auto mb-1 ml-1 gap-2">';
echo '<div title="Create a new column" class="newBoardButton flex w-64 transition-[width] ease-in-out duration-200 text-lg bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer" onclick="expandBoardCreate()">';
echo '<span class="mx-auto text-2xl">+</span>';
echo '</div>';
echo '<div title="Create a new column" class="acceptBoard flex w-64 transition-[width] ease-in-out duration-200 text-lg bg-lime-400 hover:bg-lime-500 rounded-md cursor-pointer hidden" onclick="addBoard('.$project_name.')">';
echo '<span class="mx-auto my-auto text-md">Add column</span>';
echo '</div>';
echo '<div title="Close" class="newBoardCancel flex w-8 h-8 bg-slate-200 hover:bg-slate-300 rounded-lg transition z-50 ease-in-out duration-200 hidden cursor-pointer" onclick="expandBoardCreate()">';
echo '<svg class="flex w-3 h-3 mx-auto my-auto fill-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>';
echo '</div>';
//End of new board button
echo '</div>';

?>