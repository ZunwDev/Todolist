function toggleHidden(id) {
  for (var i = 0; i < id.length; i++) {
    id[i].classList.toggle("hidden");
  }
}

function showProjectNameEdit() {
  var idOfClickedObject = event.currentTarget.parentElement.id;
  const allEditElements = document.querySelectorAll(`textarea[id$='_edit']`);
  const allNameElements = document.querySelectorAll(`div[id$='_name']`);
  const allEditControlElements = document.querySelectorAll(
    "div[id$='_editcontrol']"
  );
  const allBasicControlElements = document.querySelectorAll(`.bs`);

  allEditElements.forEach((element) => {
    element.classList.add("hidden");
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

  var oldname = document.getElementById(idOfClickedObject + "_name");
  var newname = document.getElementById(idOfClickedObject + "_edit");
  var control = document.getElementById(idOfClickedObject);
  var editcontrol = document.getElementById(idOfClickedObject + "_editcontrol");

  toggleHidden([oldname, newname, editcontrol, control]);
}

function cancelChanges() {
  var idOfClickedObject = event.currentTarget.parentElement.id;
  var editcontrol = document.getElementById(idOfClickedObject);
  var elementID = document.getElementById(
    idOfClickedObject.slice(0, idOfClickedObject.indexOf("_"))
  ); //element ID
  var control = elementID;
  var oldname = document.getElementById(control.id + "_name");
  var newname = document.getElementById(control.id + "_edit");
  newname.value = control.id;

  toggleHidden([editcontrol, control, newname, oldname]);
}

function saveChanges() {
  var idOfClickedObject = event.currentTarget.parentElement.id;
  var elementID = document.getElementById(
    idOfClickedObject.slice(0, idOfClickedObject.indexOf("_"))
  ); //element ID
  var getEditTextareaValue = document.getElementById(
    elementID.id + "_edit"
  ).value;
  $.post("./utils/scripts/saveProjectName.php", {
    oldName: elementID.id,
    newName: getEditTextareaValue,
  }).done(function (data) {
    console.log(data);
    window.location.reload();
  });
}

function showProjects() {
  var projectList = document.getElementById("projectList");
  projectList.classList.toggle("hidden");
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
