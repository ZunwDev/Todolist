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

  var projectName = $("#nameInput").val();
  var colorName = document.getElementById("currentColorName").innerText;
  if (projectName === "") {
    $.post("./utils/scripts/new_project.php", {
      projectName: "Project",
      color: colorName,
    }).done(function (data) {
      window.location.reload();
    });
  } else {
    $.post("./utils/scripts/new_project.php", {
      projectName: projectName,
      color: colorName,
    }).done(function (data) {
      window.location.reload();
    });
  }
}

function openProject() {
  let getProjectID = event.currentTarget.id;
  let getProjectElementText = document.getElementById(getProjectID).lastChild.innerText;
  location.href = `http://localhost/TodoList/project/${getProjectID}/${getProjectElementText}`;
}
