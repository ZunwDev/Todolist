function toggleHidden(id) {
  for (const element of id) {
    element.classList.toggle("hidden");
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
  const idOfClickedObject = event.currentTarget.parentElement.id;
  const getEditName = `${idOfClickedObject}_edit`;
  const input = document.getElementById(getEditName);
  sidebarDefault();
  setTimeout(() => {
    input.focus();
    input.select();
  }, 0);

  const oldname = document.getElementById(`${idOfClickedObject}_projectName`);
  const newname = document.getElementById(`${idOfClickedObject}_edit`);
  const link = document.getElementById(`${idOfClickedObject}_link`);
  const control = document.getElementById(idOfClickedObject);
  const editcontrol = document.getElementById(
    `${idOfClickedObject}_editcontrol`
  );

  toggleHidden([oldname, newname, link, editcontrol, control]);
}

function cancelChangesRename() {
  const idOfClickedObject = event.currentTarget.parentElement.id;
  const editcontrol = document.getElementById(idOfClickedObject);
  const elementID = document.getElementById(
    idOfClickedObject.slice(0, idOfClickedObject.indexOf("_"))
  ); //element ID
  const control = elementID;
  const oldname = document.getElementById(`${control.id}_projectName`);
  const newname = document.getElementById(`${control.id}_edit`);
  const link = document.getElementById(`${control.id}_link`);
  newname.value = control.id;

  toggleHidden([editcontrol, control, link, newname, oldname]);
}

function saveChanges() {
  const idOfClickedObject = event.currentTarget.parentElement.id;
  const elementID = document.getElementById(
    idOfClickedObject.slice(0, idOfClickedObject.indexOf("_"))
  ); //element ID
  const getEditTextareaValue = document.getElementById(
    `${elementID.id}_edit`
  ).value;
  $.post("http://localhost/TodoList/utils/scripts/saveProjectName.php", {
    oldName: elementID.id,
    newName: getEditTextareaValue,
  }).done((data) => {
    window.location.href = "http://localhost/TodoList/index.php";
  });
}

function showProjects() {
  $("#projectList").toggleClass("hidden");
}