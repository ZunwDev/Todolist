function getSectionID() {
  var projectSections = document.querySelectorAll(`section[id$='_id']`);
  var project_name = projectSections[0].slice(
    0,
    projectSections[0].indexOf("_")
  );
  return $.post("./scripts/getProjectID.php", {
    project_name: project_name,
  });
}

function openProjectCreate() {
  show("newProj");
  $("#newProj").removeClass("beforeShowUp");
  $("#newProj").addClass("afterShowUp");
}

function closeProjectCreate() {
  $("#newProj").removeClass("afterShowUp");
  $("#newProj").addClass("beforeShowUp");
  setTimeout(function () {
    $("#newProj").hide();
  }, 400);
}

function postCreateProject(projectName, projectDescription, colorName) {
  $.post("./utils/scripts/new_project.php", {
    projectName: projectName,
    projectDescription: projectDescription,
    color: colorName,
  }).done(function (data) {
    window.location.reload();
  });
}

function acceptProjectCreate() {
  closeProjectCreate();
  var projectName = document.getElementById("nameInput").value;
  var projectDescription = document.getElementById("descriptionInput").value;
  var colorName = document.getElementById("currentColorName").innerText;

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
}

function closeProjectSidebar(id, name, description, color) {
  var projectSections = document.querySelectorAll(`section[id$='_id']`);
  projectSections[0].remove();
  openProject(id, name, description, color);
}

function closeProject() {
  var projectSections = document.querySelectorAll(`section[id$='_id']`);
  projectSections[0].remove();
  $("#project_grid").show();
  $("#projects_nameEl").show();
  $(".project_wrapper").show();
  URL("index.php");
  title("TodoList");
}

function addBoardData(name) {
  var board = $.ajax("./utils/loadBoards.php", {
    async: false,
    type: "post",
    data: {
      project_name: name
    },
  }).done(function (data) {
    return data;
  });
  let getBoardArea = document.getElementById("boards");
  getBoardArea.insertAdjacentHTML("afterbegin", board.responseText);
}

function getHTML(name, light, color, dark, description) {
  return `<section id="${name}_id">
            <div class="flex flex-row w-full ${light} h-10 gap-2">
              <div class="flex w-64 h-full ${color}">
                <textarea title="Change project name" class="flex form-control text-2xl resize-none pt-1 pl-2 h-8 mx-2 my-auto transition ease-in-out duration-200 overflow-y-hidden rounded-lg bg-transparent hover:${dark} truncate focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600">${name}</textarea>
              </div>
              <div class="flex w-full h-full ${color}">
                <textarea title="Change project description" class="flex form-control text-sm resize-none w-full pt-2 pl-2 h-8 mx-2 my-auto transition ease-in-out overflow-y-hidden rounded-lg bg-transparent hover:${dark} truncate focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600">${description}</textarea>
              </div>
              <div title="Close project" class="flex w-16 h-full bg-slate-200 hover:bg-red-300 transition ease-in-out duration-200 cursor-pointer group" onclick="closeProject()">
                <svg class="flex w-4 h-4 mx-auto my-auto fill-slate-400 transition ease-in-out duration-200 group-hover:fill-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
              </div>
            </div>
                <section id="boards" class="flex flex-row flex-grow bg-slate-50 w-full">
                  <div title="Create new column" class="newBoard flex mt-4 ml-4 w-56 transition ease-in-out duration-200 h-8 my-auto text-lg bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer" onclick='addBoard()'>
                <span class="mx-auto text-2xl">+</span>
              </div>
            </section>
          </section>`;
}

function openProjectSidebar(id, name, description, color) {
  //Data
  let checkIfProjectIsOpen = document.querySelectorAll(`section[id$='_id']`);
  let getProjectWindow = document.getElementsByClassName(
    "app_appProjectsContainer"
  );
  var colorClass = new Color(color);
  if (checkIfProjectIsOpen.length > 0) {
    closeProjectSidebar(id, name, description, color);
  } else {
    $("#project_grid").hide();
    $("#projects_nameEl").hide();
    $(".project_wrapper").hide();
    //New window
    getProjectWindow[0].insertAdjacentHTML(
      "beforeend",
      getHTML(
        name,
        colorClass.getLighter(),
        color,
        colorClass.getDarker(),
        description
      )
    );
    addBoardData(name);
    URL(`${id}/${name}`);
    title(`TodoList: ${name}`);
  }
}

function openProject(id, name, description, color) {
  //Data
  var colorClass = new Color(color);
  let getProjectWindow = document.getElementsByClassName(
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
      colorClass.getLighter(),
      color,
      colorClass.getDarker(),
      description
    )
  );
  addBoardData(name);
  URL(`${id}/${name}`);
  title(`TodoList: ${name}`);
}

if (window.history && window.history.pushState) {
  $(window).on("popstate", function () {
    closeProject();
  });
}
