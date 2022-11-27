/**
 * It shows the div with the id "newProj" and removes the class "beforeShowUp" and adds the class
 * "afterShowUp".
 */
function openProjectCreate() {
  const loadColorSelection = $.ajax("./utils/loadColors.php", {
    async: false,
    type: "post",
    data: {},
  });
  body.insertAdjacentHTML("beforeend", `
    <section id="newProj" class="w-screen h-screen absolute bg-slate-50/25 beforeShowUp" style="display: none">
      <div id="projectCreatePopup" class="absolute flex left-0 right-0 ml-auto mr-auto top-28 flex-col h-fit w-80 shadow-lg bg-slate-50 rounded-lg">
        <div class="deleteHeader flex flex-row w-full h-8 border-b border-slate-200 gap-4">
          <div class="my-1 ml-4 w-full h-full font-bold select-none">New project</div>
          <div class="ml-auto mt-1 mr-1 flex h-fit w-fit px-1 py-1 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="closeProjectCreate()"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>
      </div>
      <form id="newProjectForm" class="app_appDialogForm flex flex-col w-full h-full bg-slate-50 rounded-b-lg" method="post">
          <div class="app_appFormField mt-4 px-6 flex flex-col gap-1">
              <label class="font-bold">Name</label>
              <input id="nameInputCreate" placeholder="e.g Work, Bussiness" type="text" class="flex shadow-md form-control block w-full px-2 text-lg font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none" autocomplete="none">
          </div>
          <div class="app_appFormField mt-4 px-6 flex flex-col gap-1">
              <label class="font-bold">Description</label>
              <textarea id="projectDescriptionCreate" placeholder="Describe this project" maxlength="128" class="descriptionInput flex overflow-y-auto shadow-md h-20 form-control block w-full px-2 text-base font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none resize-none" autocomplete="none"></textarea>
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
              <button title="Cancel - Esc" type="button" class="app_appFormCancel mt-4 py-1 px-3 mb-3 bg-slate-200 rounded-lg border border-slate-300 hover:bg-slate-300 select-none" onclick="closeProjectCreate()">
                  Cancel
              </button>
              <button title="Add - Enter" type="button" class="app_appFormAccept mt-4 py-1 px-3 mb-3 bg-slate-500 text-white rounded-lg border border-slate-400 hover:bg-slate-600 select-none" onclick="acceptProjectCreate()">
                  Add
              </button>
          </div>
      </form>
  </div>
</section>
  `);
  show("newProj");
  $("#newProj").removeClass("beforeShowUp");
  $("#newProj").addClass("afterShowUp");
  let getColorSelect = document.getElementById("colorSelect");
  getColorSelect.insertAdjacentHTML("afterbegin", loadColorSelection.responseText);
}

/**
 * It removes the class "afterShowUp" and adds the class "beforeShowUp" to the element with the id
 * "newProj". Then it hides the element with the id "newProj" after 400 milliseconds.
 */
function closeProjectCreate() {
  $("#newProj").removeClass("afterShowUp");
  $("#newProj").addClass("beforeShowUp");
  setTimeout(() => {
    $("#newProj").hide();
    const getNewProj = document.getElementById("newProj");
    getNewProj.remove();
  }, 400);
}

/**
 * It takes the project name, project description, and color name and sends it to a PHP script that
 * creates a new project.
 * @param projectName - The name of the project
 * @param projectDescription - projectDescription,
 * @param colorName - The name of the color that the user selected.
 */

function postCreateProject(projectName, projectDescription, colorName) {
  $.post("./utils/scripts/new_project.php", {
    projectName,
    projectDescription,
    color: colorName,
  }).done((data) => {
    window.location.reload();
  });
}

/**
 * If the user has entered a project name, use that as the project name. If the user has entered a
 * project description, use that as the project description. If the user has entered a color name, use
 * that as the color name. If the user has not entered a project name, use "Project" as the project
 * name. If the user has not entered a project description, use "" as the project description. If the
 * user has not entered a color name, use "Red" as the color name.
 */
function acceptProjectCreate() {
  const projectName = document.getElementById("nameInputCreate").value;
  const projectDescription = document.getElementById("projectDescriptionCreate").value;
  const colorName = document.getElementById("currentColorName").innerText;
  
  if (projectDescription != "" && projectName === "") {
    postCreateProject("Project", projectDescription, colorName);
  }
  if (projectName === "" && projectDescription === "") {
    postCreateProject("Project", "", colorName);
  }
  if (projectName != "" && projectDescription != "") {
    postCreateProject(projectName, projectDescription, colorName);
  }
  if (projectName != "" && projectDescription === "") {
    postCreateProject(projectName, "", colorName);
  }
  closeProjectCreate();
}

/**
 * It removes the first element in the NodeList returned by the querySelectorAll() method, then calls
 * the openProjectSidebar() function.
 * @param id - the id of the project
 * @param name - The name of the project
 * @param description - The description of the project
 * @param color - the color of the project
 */
function closeProjectSidebar(id, name, description, color) {
  const projectSections = document.querySelectorAll(`section[id$='_id']`);
  projectSections[0].remove();
  openProjectSidebar(id, name, description, color);
}

/**
 * It removes the first element in the projectSections array, shows the project_grid, projects_nameEl,
 * and project_wrapper elements, and changes the URL and title of the page.
 */
function closeProject() {
  const getSidebar = document.getElementById("sidebar");
  const getLastClass = getSidebar.classList.toString().split(" ").pop();
  getSidebar.classList.remove(getLastClass);
  getSidebar.classList.add("bg-slate-100");
  const projectSections = document.querySelectorAll(`section[id$='_id']`);
  projectSections[0].remove();
  $("#project_grid").show();
  $("#projects_nameEl").show();
  $(".project_wrapper").show();
  URL("index.php");
  title("TodoList");
}

function getHTML(name, light, lightplus, lightlow, color) {
  const getSidebar = document.getElementById("sidebar");
  const getLastClass = sidebar.classList.toString().split(" ").pop();
  getSidebar.classList.remove(getLastClass);
  getSidebar.classList.add(lightlow);
  return `
          <section id="${name}_id" class="flex flex-col ${lightplus} overflow-x-auto overflow-y-hidden h-full w-full">
            <div class="flex flex-row ${light} h-10 gap-2 w-full">
              <div class="flex w-fit h-full px-4 pr-12 element-percent-right ${color}">
                <div class="flex text-2xl text-white h-8 mx-2 my-auto">${name}</div>
              </div>
              <div class="flex flex-row gap-1 ml-auto mr-1">
                <div title="Project settings" class="flex w-12 h-full bg-slate-200 hover:bg-slate-300 transition ease-in-out duration-200 cursor-pointer group" onclick="showProjectEdit('${name.trim()}')">
                  <svg class="flex w-4 h-4 mx-auto my-auto fill-slate-400 transition ease-in-out duration-200 group-hover:fill-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336c44.2 0 80-35.8 80-80s-35.8-80-80-80s-80 35.8-80 80s35.8 80 80 80z"/></svg>
                </div>
                <div title="Close project" class="flex w-12 h-full bg-slate-200 hover:bg-red-300 transition ease-in-out duration-200 cursor-pointer group" onclick="closeProject()">
                  <svg class="flex w-4 h-4 mx-auto my-auto fill-slate-400 transition ease-in-out duration-200 group-hover:fill-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
                </div>
              </div>
            </div>
            <section id="boards" class="flex flex-row ${lightplus} mt-4 ml-4 gap-4 overflow-x-auto overflow-y-hidden"></section>
          </section>`;
}

function openProjectSidebar(id, name, description, color) {
  //Data
  const checkIfProjectIsOpen = document.querySelectorAll(`section[id$='_id']`);
  const getProjectWindow = document.getElementsByClassName(
    "app_appProjectsContainer"
  );
  const colorClass = new Color(color);
  if (checkIfProjectIsOpen.length > 0) {
    closeProjectSidebar(id, name, description, color);
    return;
  }
  $("#project_grid").hide();
  $("#projects_nameEl").hide();
  $(".project_wrapper").hide();
  //New window
  getProjectWindow[0].insertAdjacentHTML(
    "beforeend",
    getHTML(
      name,
      colorClass.getLighter(100),
      colorClass.getLighter(300),
      colorClass.getLighter(400),
      color
    )
  );
  setTimeout(() => {
    document.getElementById("boards").innerText = "";
    const board = $.ajax("../utils/loadBoards.php", {
      async: false,
      type: "post",
      data: {
        project_name: name,
      },
    });
    const getBoardArea = document.getElementById("boards");
    getBoardArea.insertAdjacentHTML("afterbegin", board.responseText);
  }, 50);
  URL(`${id}/${name}`);
  title(`TodoList: ${name}`);
}

function openProject(id, name, color) {
  //Data
  const colorClass = new Color(color);
  const getProjectWindow = document.getElementsByClassName(
    "app_appProjectsContainer"
  );
  //Hiding projects
  $("#project_grid").hide();
  $("#projects_nameEl").hide();
  $(".project_wrapper").hide();
  //New window

  getProjectWindow[0].insertAdjacentHTML(
    "beforeend",
    getHTML(
      name,
      colorClass.getLighter(100),
      colorClass.getLighter(300),
      colorClass.getLighter(400),
      color
    )
  );
  setTimeout(() => {
    document.getElementById("boards").innerText = "";
    const board = $.ajax("../utils/loadBoards.php", {
      async: false,
      type: "post",
      data: {
        project_name: name,
      },
    });
    const getBoardArea = document.getElementById("boards");
    getBoardArea.insertAdjacentHTML("afterbegin", board.responseText);
  }, 50);
  URL(`${id}/${name}`);
  title(`TodoList: ${name}`);
}

/* Checking if the browser supports the history API. If it does, it adds an event listener to the
window object that listens for the popstate event. When the popstate event is fired, it calls the
closeProject() function. */
if (window.history?.pushState) {
  $(window).on("popstate", () => {
    closeProject();
  });
}
