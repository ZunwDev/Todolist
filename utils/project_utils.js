/**
 * It shows the div with the id "newProj" and removes the class "beforeShowUp" and adds the class
 * "afterShowUp".
 */
function openProjectCreate() {
  show("newProj");
  $("#newProj").removeClass("beforeShowUp");
  $("#newProj").addClass("afterShowUp");
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
    projectName: projectName,
    projectDescription: projectDescription,
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
  closeProjectCreate();
  const projectName = document.getElementById("nameInput").value;
  const projectDescription = document.getElementById("descriptionInput").value;
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
  const projectSections = document.querySelectorAll(`section[id$='_id']`);
  projectSections[0].remove();
  $("#project_grid").show();
  $("#projects_nameEl").show();
  $(".project_wrapper").show();
  URL("index.php");
  title("TodoList");
}

function getHTML(name, light, color, dark, description) {
  return `
          <section id="${name}_id" class="flex flex-shrink flex-col">
            <div class="flex flex-row ${light} h-10 gap-2">
              <div class="flex w-64 h-full ${color} ml-2">
                <textarea title="Change project name" class="flex form-control text-2xl resize-none pt-1 pl-2 h-8 mx-2 my-auto transition ease-in-out duration-200 overflow-y-hidden rounded-lg bg-transparent hover:${dark} truncate focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600">${name}</textarea>
              </div>
              <div class="flex ml-auto">
                <div title="Close project" class="flex w-16 h-full bg-slate-200 hover:bg-red-300 transition ease-in-out duration-200 cursor-pointer group" onclick="closeProject()">
                  <svg class="flex w-4 h-4 mx-auto my-auto fill-slate-400 transition ease-in-out duration-200 group-hover:fill-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
                </div>
              </div>
            </div>
            <section id="boards" class="flex flex-row bg-slate-50 overflow-x-auto"></section>
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
}

function openProject(id, name, description, color) {
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
      colorClass.getLighter(),
      color,
      colorClass.getDarker(),
      description
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
