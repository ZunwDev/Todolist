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
  let getProjectElementText =
    document.getElementById(getProjectID).lastChild.innerText;
  location.href = `http://localhost/TodoList/project/${getProjectID}/${getProjectElementText}`;
}
