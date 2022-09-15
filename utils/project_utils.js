function openProjectCreate() {
  var newProjectWindow = document.getElementById("newProj");
  newProjectWindow.style.display = "block";
  newProjectWindow.classList.remove("beforeShowUp");
  newProjectWindow.classList.add("afterShowUp");
}

function closeProjectCreate() {
  var newProjectWindow = document.getElementById("newProj");
  newProjectWindow.classList.remove("afterShowUp");
  newProjectWindow.classList.add("beforeShowUp");
  setTimeout(function () {
    newProjectWindow.style.display = "none";
  }, 400);
}

function acceptProjectCreate() {
  var newProjectWindow = document.getElementById("newProj");
  newProjectWindow.classList.remove("afterShowUp");
  newProjectWindow.classList.add("beforeShowUp");
  setTimeout(function () {
    newProjectWindow.style.display = "none";
  }, 400);

  function postCreateProject(projectName, projectDescription, colorName) {
    $.post("./utils/scripts/new_project.php", {
      projectName: projectName,
      projectDescription: projectDescription,
      color: colorName,
    }).done(function (data) {
      window.location.reload();
    });
  }

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

function openProject() {
  let getProjectID = event.currentTarget.id;
  let getProjectGrid = document.getElementById("project_grid");
  let getProjectGridName = document.getElementById("projects_nameEl");
  getProjectGrid.style.display = "none";
  getProjectGridName.style.display = "none";

  let getProjectWindow = document.getElementsByClassName("app_appProjectsContainer");
  var html = `
    <div class="bg-slate-300 relative w-full h-full flex flex-row">
      <div class="flex bg-slate-500 w-full h-full mb-auto"></div>
      <div id="project_sidebar" class="flex h-full w-48 bg-slate-400 ml-auto"></div>
    </div>`;
  getProjectWindow[0].insertAdjacentHTML('beforeend', html);

  /*   history.replaceState({
      id: 'TodoList',
      source: 'web'
    }, 'TodoList', `http://localhost/TodoList/${getProjectID}/${requiredDiv}`); */
}
