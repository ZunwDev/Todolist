/**
 * It shows the div with the id "newProj" and removes the class "beforeShowUp" and adds the class
 * "afterShowUp".
 */
function openProjectCreate() {
  body.insertAdjacentHTML(
    'beforeend',
    `
    <section id="popupOverlay" class="w-screen h-screen absolute bg-slate-50/25">
      <div id="popupElement" class="absolute flex left-0 right-0 ml-auto mr-auto top-28 flex-col h-fit w-80 shadow-lg bg-slate-50 rounded-lg beforeShowUp">
        <div class="deleteHeader flex flex-row w-full h-8 border-b border-slate-200 gap-4">
          <div class="my-1 ml-4 w-full h-full font-bold">New project</div>
          <div class="ml-auto mt-1 mr-1 flex h-fit w-fit px-1 py-1 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="closeAnyPopup()"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>
      </div>
      <form id="newProjectForm" class="app_appDialogForm flex flex-col w-full h-full bg-slate-50 rounded-b-lg" method="post">
          <div class="app_appFormField mt-4 px-6 flex flex-col gap-1">
              <label class="font-bold">Name</label>
              <input autocomplete="none" id="nameInputCreate" placeholder="e.g Work, Bussiness" type="text" class="flex shadow-md form-control block w-full px-2 text-lg font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none" autocomplete="none">
          </div>
          <div class="app_appFormField mt-4 px-6 flex flex-col gap-1">
              <label class="font-bold">Description</label>
              <textarea autocomplete="none" id="projectDescriptionCreate" placeholder="Describe this project" maxlength="128" class="descriptionInput flex overflow-y-auto shadow-md h-20 form-control block w-full px-2 text-base font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none resize-none" autocomplete="none"></textarea>
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
                  <div id="colorSelect" class="flex flex-wrap mx-auto py-3 pl-[1.15rem] gap-2 relative w-fit h-0 opacity-0 duration-100 bg-slate-100 rounded-lg mt-4 transition-[height]" style="display: none">
                  </div>
              </div>
          </div>
          <div class="app_appFormControl flex flex-row gap-2 justify-end mr-2">
              <button title="Cancel - Esc" type="button" class="app_appFormCancel mt-4 py-1 px-3 mb-3 bg-slate-200 rounded-lg border border-slate-300 hover:bg-slate-300" onclick="closeAnyPopup()">
                  Cancel
              </button>
              <button title="Add - Enter" type="button" class="app_appFormAccept mt-4 py-1 px-3 mb-3 bg-slate-500 text-white rounded-lg border border-slate-400 hover:bg-slate-600" onclick="acceptProjectCreate()">
                  Add
              </button>
          </div>
      </form>
  </div>
</section>
  `
  );
  let colorSelect = $.ajax('./utils/load/other/loadColors.php', {
    async: false,
    type: 'post',
  });
  let getColorSelect = document.getElementById('colorSelect');
  getColorSelect.insertAdjacentHTML('afterbegin', colorSelect.responseText);
  popupModalSettings();
}

/**
 * It takes the project name, project description, and color name and sends it to a PHP script that
 * creates a new project.
 * @param projectName - The name of the project
 * @param projectDescription - projectDescription,
 * @param colorName - The name of the color that the user selected.
 */

function postCreateProject(projectName, projectDescription, colorName) {
  $.post('./utils/scripts/project/new_project.php', {
    projectName,
    projectDescription,
    color: colorName,
  }).done((data) => {
    window.location.reload();
  });
}

/**
 * It takes the values of the inputs and sends them to the server.
 */
function acceptProjectCreate() {
  const projectName = document.getElementById('nameInputCreate').value;
  const projectDescription = document.getElementById('projectDescriptionCreate').value;
  const colorName = document.getElementById('currentColorName').innerText;

  let finalProjectName = projectName == '' ? 'Project' : projectName;
  let finalDescription = projectDescription == '' ? '' : projectDescription;

  postCreateProject(finalProjectName, finalDescription, colorName);
  closeAnyPopup();
}

/**
 * It removes the first element in the NodeList returned by the querySelectorAll() method, then calls
 * the openProjectSidebar() function.
 * @param id - the id of the project
 * @param name - The name of the project
 * @param description - The description of the project
 * @param color - the color of the project
 */
function closeProjectSidebar(id, color, projectName) {
  const projectSections = document.querySelectorAll(`section[id$='_id']`);
  projectSections[0].remove();
  openProjectSidebar(id, color, projectName);
}

/**
 * It removes the first element in the projectSections array, shows the project_grid, projects_nameEl,
 * and project_wrapper elements, and changes the URL and title of the page.
 */
function closeProject() {
  const getSidebar = document.getElementById('sidebar');
  const getSidebarProjectText = document.getElementById('app_appProjectTab');
  const projectSections = document.querySelectorAll(`section[id$='_id']`);

  const lastClass = getSidebar.classList.item(getSidebar.classList.length - 1);
  getSidebar.classList.replace(lastClass, 'bg-slate-100');

  const lastClassText = getSidebarProjectText.classList.item(getSidebarProjectText.classList.length - 1);
  getSidebarProjectText.classList.replace(lastClassText, 'hover:bg-slate-200');

  projectSections[0].remove();
  $('#project_grid').show();
  $('#projects_nameEl').show();
  $('.project_wrapper').show();
  URL('index.php');
  title('TodoList');
}

function getHTML(name, light, lightplus, lightlow, color, id) {
  const getSidebar = document.getElementById('sidebar');
  const getSidebarProjectText = document.getElementById('app_appProjectTab');

  const lastClass = getSidebar.classList.item(getSidebar.classList.length - 1);
  getSidebar.classList.replace(lastClass, lightlow);

  const lastClassText = getSidebarProjectText.classList.item(getSidebarProjectText.classList.length - 1);
  getSidebarProjectText.classList.replace(lastClassText, 'hover:' + lightplus);

  let favState = getFavoriteStatus(id);
  let starColor = favState == 0 ? "" : "fill-amber-400";
  let titleText = favState == 0 ? "Favorite" : "Unfavorite";

  return `
          <section id="${name}_id" class="flex flex-col overflow-x-auto overflow-y-hidden h-full bg-slate-100 w-full">
            <div class="flex flex-row h-10 gap-2 w-full border-b border-slate-300 bg-slate-50">
              <div class="flex w-fit h-full px-4">
                <div class="flex text-2xl truncate text-gray-700 h-8 mx-2 my-auto">${name}</div>
              </div>
              <div title="${titleText} this project" class="flex my-auto cursor-pointer" onclick="favoriteProject(${id})"><svg class="w-5 h-5 ${starColor}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M287.9 0C297.1 0 305.5 5.25 309.5 13.52L378.1 154.8L531.4 177.5C540.4 178.8 547.8 185.1 550.7 193.7C553.5 202.4 551.2 211.9 544.8 218.2L433.6 328.4L459.9 483.9C461.4 492.9 457.7 502.1 450.2 507.4C442.8 512.7 432.1 513.4 424.9 509.1L287.9 435.9L150.1 509.1C142.9 513.4 133.1 512.7 125.6 507.4C118.2 502.1 114.5 492.9 115.1 483.9L142.2 328.4L31.11 218.2C24.65 211.9 22.36 202.4 25.2 193.7C28.03 185.1 35.5 178.8 44.49 177.5L197.7 154.8L266.3 13.52C270.4 5.249 278.7 0 287.9 0L287.9 0zM287.9 78.95L235.4 187.2C231.9 194.3 225.1 199.3 217.3 200.5L98.98 217.9L184.9 303C190.4 308.5 192.9 316.4 191.6 324.1L171.4 443.7L276.6 387.5C283.7 383.7 292.2 383.7 299.2 387.5L404.4 443.7L384.2 324.1C382.9 316.4 385.5 308.5 391 303L476.9 217.9L358.6 200.5C350.7 199.3 343.9 194.3 340.5 187.2L287.9 78.95z"/></svg></div>
              <div class="flex flex-row gap-1 ml-auto mr-1">
                <div title="Project settings" class="flex w-fit h-fit px-2 py-2 rounded-full my-auto mr-4 hover:bg-slate-300 transition ease-in-out duration-200 cursor-pointer group" onclick="showProjectEdit('${id}')">
                  <svg class="w-5 h-5 mx-auto my-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M120 256c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm160 0c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm104 56c-30.9 0-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56s-25.1 56-56 56z"/></svg></div>
              </div>
            </div>
            <section id="boards" class="flex flex-row mt-4 ml-4 gap-4 h-full overflow-x-auto overflow-y-hidden"></section>
          </section>`;
}

function favoriteProject(id) {
  $.post("../utils/scripts/project/favoriteProject.php", {
      projectID: id,
  }).done(data => {
    //console.log(data);
    closeProject();
    openProject(id);
  })
}

function openProjectSidebar(id, color, projectName) {
  const checkIfProjectIsOpen = document.querySelectorAll(`section[id$='_id']`);
  if (checkIfProjectIsOpen.length > 0) {
    closeProjectSidebar(id, color, projectName);
    return;
  }
  const getProjectWindow = document.getElementsByClassName('app_appProjectsContainer');
  const colorClass = new Color(color);
  $('#project_grid').hide();
  $('#projects_nameEl').hide();
  $('.project_wrapper').hide();
  //New window
  getProjectWindow[0].insertAdjacentHTML(
    'beforeend',
    getHTML(projectName, colorClass.getLighter(100), colorClass.getLighter(300), colorClass.getLighter(400), color, id)
  );
  setTimeout(() => {
    document.getElementById('boards').innerText = '';
    let board = getBoardData(id);
    const getBoardArea = document.getElementById('boards');
    getBoardArea.insertAdjacentHTML('afterbegin', board);
  }, 50);
  URL(`${id}/${projectName}`);
  title(`TodoList: ${projectName}`);
}

function openProject(id) {
  //Data
  let colorCode = getColorCode(id);
  let projectName = getProjectName(id);

  const colorClass = new Color(colorCode);
  const getProjectWindow = document.getElementsByClassName('app_appProjectsContainer');
  //Hiding projects
  $('#project_grid').hide();
  $('#projects_nameEl').hide();
  $('.project_wrapper').hide();
  //New window

  getProjectWindow[0].insertAdjacentHTML(
    'beforeend',
    getHTML(
      projectName,
      colorClass.getLighter(100),
      colorClass.getLighter(300),
      colorClass.getLighter(400),
      colorCode,
      id
    )
  );
  setTimeout(() => {
    document.getElementById('boards').innerText = '';
    let board = getBoardData(id);
    const getBoardArea = document.getElementById('boards');
    getBoardArea.insertAdjacentHTML('afterbegin', board);
  }, 50);
  URL(`${id}/${projectName}`);
  title(`TodoList: ${projectName}`);
}

/* Checking if the browser supports the history API. If it does, it adds an event listener to the
window object that listens for the popstate event. When the popstate event is fired, it calls the
closeProject() function. */
if (window.history?.pushState) {
  $(window).on('popstate', () => {
    closeProject();
  });
}
