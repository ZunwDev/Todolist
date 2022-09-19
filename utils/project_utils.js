function openProjectCreate() {
  $("#newProj").show();
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

function closeProjectSidebar() {
  var projectSections = document.querySelectorAll(`section[id$='_id']`);
  projectSections[0].remove();
  openProject();
}

function closeProject() {
  window.location.href = "http://localhost/TodoList/index.php";
}

function openProjectSidebar(id, name, description, color) {
  //Data
  const onlyNum = color.replace(/\D/g, '');
  let num;

  if (onlyNum !== '') {
    num = Number(onlyNum);
  }

  var splittedColor = color.split("-");
  var lightColor = "bg-" + splittedColor[1] + "-" + (num - 100);
  var darkColor = "bg-" + splittedColor[1] + "-" + (num + 100);

  let checkIfProjectIsOpen = document.querySelectorAll(`section[id$='_id']`);
  let getProjectWindow = document.getElementsByClassName(
    "app_appProjectsContainer"
  );
  if (checkIfProjectIsOpen.length > 0) {
    closeProjectSidebar();
  } else {
    $("#project_grid").hide();
    $("#projects_nameEl").hide();
    $(".app_appProjectsContainer").removeClass("pl-16");
    //New window
    var html = `
    <section id="${name}_id">
    <div class="flex flex-row w-full ${lightColor} h-10 gap-2">
      <div class="flex w-64 h-full ${color}">
        <textarea title="Change project name" class="flex form-control text-xl resize-none pt-1 pl-2 h-8 mx-2 my-auto transition ease-in-out duration-200 overflow-y-hidden rounded-lg bg-transparent hover:${darkColor} truncate focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600">${name}</textarea>
      </div>
      <div class="flex w-full h-full ${color}">
        <textarea title="Change project description" class="flex form-control text-sm resize-none w-full pt-2 pl-2 h-8 mx-2 my-auto transition ease-in-out overflow-y-hidden rounded-lg bg-transparent hover:${darkColor} truncate focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600">${description}</textarea>
      </div>
      <div title="Close project" class="flex w-16 h-full bg-slate-200 hover:bg-red-300 transition ease-in-out duration-200 cursor-pointer group" onclick="closeProject()">
        <svg class="flex w-4 h-4 mx-auto my-auto fill-slate-400 transition ease-in-out duration-200 group-hover:fill-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
      </div>
    </div>
      <div class="relative w-full h-full flex flex-row">
        <div class="flex bg-slate-50 w-full h-full">
          <div title="Create new column" class="newBoard flex mt-4 ml-4 w-56 transition ease-in-out duration-200 h-8 my-auto text-lg bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer">
        <span class="mx-auto text-2xl">+</span>
        </div>
      </div>
    </div>
  </section>`;

    getProjectWindow[0].insertAdjacentHTML("beforeend", html);

    history.replaceState({
        id: "TodoList",
        source: "web",
      },
      "TodoList",
      `http://localhost/TodoList/${id}/${name}`
    );
  }
}

function openProject(id, name, description, color) {
  //Data
  const onlyNum = color.replace(/\D/g, '');
  let num;

  if (onlyNum !== '') {
    num = Number(onlyNum);
  }

  var splittedColor = color.split("-");
  var lightColor = "bg-" + splittedColor[1] + "-" + (num - 100);
  var darkColor = "bg-" + splittedColor[1] + "-" + (num + 100);

  let getProjectWindow = document.getElementsByClassName(
    "app_appProjectsContainer"
  );
  //Hiding projects
  $("#project_grid").hide();
  $("#projects_nameEl").hide();
  $(".app_appProjectsContainer").removeClass("pl-16");
  //New window
  var html = `
       <section id="${name}_id">
      <div class="flex flex-row w-full ${lightColor} h-10 gap-2">
        <div class="flex w-64 h-full ${color}">
          <textarea title="Change project name" class="flex form-control text-xl resize-none pt-1 pl-2 h-8 mx-2 my-auto transition ease-in-out duration-200 overflow-y-hidden rounded-lg bg-transparent hover:${darkColor} truncate focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600">${name}</textarea>
        </div>
        <div class="flex w-full h-full ${color}">
          <textarea title="Change project description" class="flex form-control text-sm resize-none w-full pt-2 pl-2 h-8 mx-2 my-auto transition ease-in-out overflow-y-hidden rounded-lg bg-transparent hover:${darkColor} truncate focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600">${description}</textarea>
        </div>
        <div title="Close project" class="flex w-16 h-full bg-slate-200 hover:bg-red-300 transition ease-in-out duration-200 cursor-pointer group" onclick="closeProject()">
          <svg class="flex w-4 h-4 mx-auto my-auto fill-slate-400 transition ease-in-out duration-200 group-hover:fill-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
        </div>
      </div>
        <div class="relative w-full h-full flex flex-row">
          <div class="flex bg-slate-50 w-full h-full">
            <div title="Create new column" class="newBoard flex mt-4 ml-4 w-56 transition ease-in-out duration-200 h-8 my-auto text-lg bg-slate-200 hover:bg-slate-300 rounded-md cursor-pointer">
          <span class="mx-auto text-2xl">+</span>
          </div>
        </div>
      </div>
    </section>`;

  getProjectWindow[0].insertAdjacentHTML("beforeend", html);

  history.pushState({
      id: "TodoList",
      source: "web",
    },
    "TodoList",
    `http://localhost/TodoList/${id}/${name}`
  );
}

if (window.history && window.history.pushState) {
  $(window).on("popstate", function () {
    closeProject();
  });
}