function toggleHidden(id) {
  for (var i = 0; i < id.length; i++) {
    id[i].classList.toggle("hidden");
  }
}

function sidebarDefault() {
  const allEditElements = document.querySelectorAll(`textarea[id$='_edit']`);
  const allLinkElements = document.querySelectorAll(`a[id$='_link']`);
  const allNameElements = document.querySelectorAll(`div[id$='_projectName']`);
  const allEditControlElements = document.querySelectorAll(
    "div[id$='_editcontrol']"
  );
  const allBasicControlElements = document.querySelectorAll(`.bs`);

  allEditElements.forEach((element) => {
    element.classList.add("hidden");
  });
  allLinkElements.forEach((element) => {
    element.classList.remove("hidden");
  });
  allNameElements.forEach((element) => {
    element.classList.remove("hidden");
  });
  allBasicControlElements.forEach((element) => {
    element.classList.remove("hidden");
  });
  allEditControlElements.forEach((element) => {
    element.classList.add("hidden");
  });
}

function showProjectNameEdit() {
  var idOfClickedObject = event.currentTarget.parentElement.id;
  var getEditName = idOfClickedObject + "_edit";
  sidebarDefault();
  setTimeout(function () {
    $(`#${getEditName}`).focus();
    $(`#${getEditName}`).select();
  }, 0);

  var oldname = document.getElementById(idOfClickedObject + "_projectName");
  var newname = document.getElementById(idOfClickedObject + "_edit");
  var link = document.getElementById(idOfClickedObject + "_link");
  var control = document.getElementById(idOfClickedObject);
  var editcontrol = document.getElementById(idOfClickedObject + "_editcontrol");

  toggleHidden([oldname, newname, link, editcontrol, control]);
}

function cancelChanges() {
  var idOfClickedObject = event.currentTarget.parentElement.id;
  var editcontrol = document.getElementById(idOfClickedObject);
  var elementID = document.getElementById(
    idOfClickedObject.slice(0, idOfClickedObject.indexOf("_"))
  ); //element ID
  var control = elementID;
  var oldname = document.getElementById(control.id + "_projectName");
  var newname = document.getElementById(control.id + "_edit");
  var link = document.getElementById(control.id + "_link");
  newname.value = control.id;

  toggleHidden([editcontrol, control, link, newname, oldname]);
}

function saveChanges() {
  var idOfClickedObject = event.currentTarget.parentElement.id;
  var elementID = document.getElementById(
    idOfClickedObject.slice(0, idOfClickedObject.indexOf("_"))
  ); //element ID
  var getEditTextareaValue = document.getElementById(
    elementID.id + "_edit"
  ).value;
  $.post("http://localhost/TodoList/utils/scripts/saveProjectName.php", {
    oldName: elementID.id,
    newName: getEditTextareaValue,
  }).done(function (data) {
    console.log(data);
    window.location.href = "http://localhost/TodoList/index.php";
  });
}

function showProjects() {
  $("#projectList").toggleClass("hidden");
}

function deleteProject() {
  var idOfClickedObject = event.currentTarget.parentElement.id;
  var projectName = document.getElementById(
    idOfClickedObject + "_name"
  ).innerText;
  $.post("./utils/scripts/deleteProject.php", {
    projectName: projectName,
  }).done(function (data) {
    window.location.reload();
  });
}
