/* Getting the project ID from the database. */
function addBoard(id) {
  const newProjectName = document.getElementById("newBoardInput").value;
  let finalProjectName = newProjectName.length > 0 ? newProjectName : "Column";
  /* Adding a new board to the database. */
  $.post("../utils/scripts/addNewBoard.php", {
    projectID: id,
    board_name: finalProjectName,
  }).done((data) => {
    reloadBoardData(id);
  });
}

/**
 * When the user clicks the button, the button expands and a text input appears
 */
function expandBoardCreate() {
  $(".newBoard").toggleClass("h-8");
  $(".newBoard").toggleClass("h-20");
  $(".newBoard").toggleClass("bg-slate-100");
  $(".newBoardButton").toggleClass("w-64");
  $(".newBoardButton").toggleClass("w-[13rem]");
  $(".acceptBoard").toggleClass("w-64");
  $(".acceptBoard").toggleClass("w-[13rem]");
  $(".newBoardButton").toggleClass("hidden");
  $(".acceptBoard").toggleClass("hidden");
  $(".newBoardCancel").toggleClass("hidden");

  const input = document.getElementById("newBoardInput");
  input.classList.toggle("hidden");
  setTimeout(() => {
    input.focus();
    input.select();
  }, 0);
}

function reloadBoardData(id) {
  /* Reloading the board data. */
  document.getElementById("boards").innerText = "";
  let board = getBoardData(id);
  const getBoardArea = document.getElementById("boards");
  getBoardArea.insertAdjacentHTML("afterbegin", board);
}

/**
 * This function hides the confirm and cancel buttons, shows the add new task button, and removes all
 * existing tasks.
 */
function resetAllNewTasks() {
  const confirmButton = document.querySelectorAll(`[id*='_confirm']`);
  const cancelButton = document.querySelectorAll(`[id*='_cancel']`);
  const existingTasks = document.querySelectorAll(`div.edit`);
  const addNewTaskButton = document.querySelectorAll(`[id*='_add']`);

  for (var i = 0; i < confirmButton.length; i++) {
    confirmButton[i].classList.add("hidden");
    cancelButton[i].classList.add("hidden");
  }

  for (var i = 0; i < addNewTaskButton.length; i++) {
    addNewTaskButton[i].classList.remove("hidden");
  }

  for (var i = 0; i < existingTasks.length; i++) {
    existingTasks[i].remove();
  }
}

function showPriorityList() {
  closePriorityList();
  let priorityList = getPriorityListPopup();

  body.insertAdjacentHTML("beforeend", priorityList);
  const priorityPopup = document.getElementById("priorityListPopup");
  priorityPopup.classList.add(`left-[${mouse.x + 8}px]`);
  priorityPopup.classList.add(`top-[${mouse.y - 128}px]`);
  priorityPopup.classList.toggle("beforeShowUp");
  priorityPopup.classList.toggle("afterShowUp");
  const priorityModal = document.getElementById("priorityListOverlay");
  priorityModal.addEventListener("click", closePriorityModalWindowOnBlur);
}

function closePriorityList() {
  const findPriorityList = document.getElementById("priorityListOverlay");
  if (findPriorityList != null) {
    findPriorityList.remove();
  }
}

function savePriority(name) {
  switch (name) {
    case "High":
      var color = "bg-red-100";
      break;
    case "Medium":
      var color = "bg-amber-100";
      break;
    case "Low":
      var color = "bg-slate-100";
      break;
    case "None":
      var color = "bg-transparent";
      break;
    default:
      var color = "bg-transparent";
      break;
  }
  const prioritySel = document.getElementById("priorityList");
  for (let i = 0; i < 2; i++) {
    prioritySel.classList.remove(
      prioritySel.classList.toString().split(" ").pop()
    );
  }
  prioritySel.classList.add(color);
  const priorityName = document.getElementById("priorityListText");
  if (name !== "None") {
    prioritySel.classList.add("border-slate-300");
    priorityName.innerText = name;
  } else {
    prioritySel.classList.add("border-transparent");
    priorityName.innerText = "";
  }
  closePriorityList();
}

function showTaskManagePopup(dataID) {
  closeTaskManagePopup();
  let loadTaskManagePopup = getTaskManagePopup(dataID);

  body.insertAdjacentHTML("beforeend", loadTaskManagePopup);
  const taskManagePopup = document.getElementById("taskManagePopup");
  taskManagePopup.classList.add(`left-[${mouse.x + 8}px]`);
  taskManagePopup.classList.add(`top-[${mouse.y - 128}px]`);
  taskManagePopup.classList.toggle("beforeShowUp");
  taskManagePopup.classList.toggle("afterShowUp");
  const taskModal = document.getElementById("taskManageOverlay");
  taskModal.addEventListener("click", closeTaskModalWindowOnBlur);
}

function closeTaskManagePopup() {
  const findTaskManagePopup = document.getElementById("taskManageOverlay");
  if (findTaskManagePopup != null) {
    findTaskManagePopup.remove();
  }
}

function deleteTask(taskID) {
  closeTaskManagePopup();
  body.insertAdjacentHTML(
    "beforeend",
    `
  <div id="taskDeletionOverlay" class="flex w-screen h-screen absolute bg-white/25">
    <div class="flex flex-col w-80 h-fit top-28 bg-slate-50 shadow-xl absolute left-0 right-0 ml-auto mr-auto rounded-lg">
      <div class="deleteHeader flex flex-row w-full h-8 border-b border-slate-200 gap-4">
        <div class="my-1 ml-4 w-full h-full font-bold">Task deletion</div>
        <div class="ml-auto mt-1 mr-1 flex h-fit w-fit px-1 py-1 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="cancelTaskDeletion()"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>
      </div>
      <div class="w-full py-2 px-4 h-fit text-sm">Are you sure you want to delete this task?</div>
      <div class="flex flex-row gap-2 py-2 ml-auto mr-2">
        <div class="w-fit h-fit px-3 py-1 bg-slate-100 border border-slate-200 hover:bg-slate-300 rounded-lg cursor-pointer" onclick="cancelTaskDeletion()">Cancel</div>
        <div class="w-fit h-fit px-3 py-1 bg-slate-500 border border-slate-400 hover:bg-slate-600 rounded-lg cursor-pointer text-slate-50" onclick="confirmTaskDelete('${taskID}')">Delete</div>
      </div>
    </div>
  </div>
  `
  );
  const taskDeleteModal = document.getElementById("taskDeletionOverlay");
  taskDeleteModal.addEventListener("click", closeTaskDeleteModalWindowOnBlur);
}

function cancelTaskDeletion() {
  const getOverlay = document.getElementById("taskDeletionOverlay");
  if (getOverlay != null) {
    getOverlay.remove();
  }
}

function cancelTaskEdit() {
  const getOverlay = document.getElementById("taskEditOverlay");
  if (getOverlay != null) {
    getOverlay.remove();
  }
}

function confirmTaskDelete(taskID) {
  let projectID = getProjectIdFromTaskId(taskID);
  $.post("../utils/scripts/deleteTask.php", {
    taskID,
  }).done((data) => {
    cancelTaskDeletion();
    reloadBoardData(projectID);
  });
}

function showTaskEditPopup(dataID) {
  closeTaskManagePopup();
  let loadTaskEditPopup = getTaskEditPopup(dataID);

  body.insertAdjacentHTML("beforeend", loadTaskEditPopup);
  const taskEditPopup = document.getElementById("taskEditPopup");
  taskEditPopup.classList.toggle("beforeShowUp");
  taskEditPopup.classList.toggle("afterShowUp");
  const editTaskModal = document.getElementById("taskEditOverlay");
  editTaskModal.addEventListener("click", closeTaskEditModalWindowOnBlur);
}

function saveTaskEdit(dataID, boardID) {
  let projectID = getProjectIdFromBoardId(boardID);
  let newTaskName = document.getElementById("taskNameEdit").value;
  let newTaskDescription = document.getElementById("taskDescriptionEdit").value;
  let newDueTo = document.getElementById("taskDueToEdit").value;
  let newPriority = document.getElementById("priorityListText").innerText;
  if (newTaskName == "") {
    let getTaskAmount =
      document.querySelectorAll(`[class*='board_${boardID}']`) + 1;
    newTaskName = `Task ${getTaskAmount}`;
  }
  if (newTaskDescription == "") {
    newTaskDescription = "";
  }
  if (newDueTo == "") {
    newDueTo = "0000-00-00";
  }
  if (newPriority == "") {
    newPriority = "None";
  }

  setTimeout(() => {
    $.post("../utils/scripts/saveTaskEdit.php", {
      dataID,
      task_name: newTaskName,
      task_description: newTaskDescription,
      task_dueTo: newDueTo,
      task_priority: newPriority,
    }).done((data) => {
      cancelTaskEdit();
      reloadBoardData(projectID);
    });
  }, 30);
}

function showColumnEdit(boardID) {
  let loadColumnEditPopup = getColumnEditPopup(boardID);

  body.insertAdjacentHTML("beforeend", loadColumnEditPopup);
  const columnEditPopup = document.getElementById("columnEditPopup");
  columnEditPopup.classList.toggle("beforeShowUp");
  columnEditPopup.classList.toggle("afterShowUp");
  const editColumnModal = document.getElementById("columnEditOverlay");
  editColumnModal.addEventListener("click", closeColumnEditModalWindowOnBlur);
}

function cancelColumnEdit() {
  const getOverlay = document.getElementById("columnEditOverlay");
  if (getOverlay != null) {
    getOverlay.remove();
  }
}

function showProjectEdit(id) {
  let loadProjectEditPopup = getProjectEditPopup(id);

  body.insertAdjacentHTML("beforeend", loadProjectEditPopup);
  const projectEditPopup = document.getElementById("projectEditPopup");
  projectEditPopup.classList.toggle("beforeShowUp");
  projectEditPopup.classList.toggle("afterShowUp");
  const editProjectModal = document.getElementById("projectEditOverlay");
  editProjectModal.addEventListener("click", closeProjectEditModalWindowOnBlur);
}

function postUpdateProject(
  projectName,
  projectDescription,
  colorName,
  projectID
) {
  $.post("../utils/scripts/saveProjectEdit.php", {
    projectName,
    projectDescription,
    color: colorName,
    projectID: projectID,
  }).done((data) => {
    //console.log(data);
    window.location.reload();
  });
}

function showProjectDeleteWarning(id) {
  cancelProjectEdit();
  body.insertAdjacentHTML(
    "beforeend",
    `
  <div id="projectDeletionOverlay" class="flex w-screen h-screen absolute bg-white/25">
    <div class="flex flex-col w-80 h-fit top-28 bg-slate-50 shadow-xl absolute left-0 right-0 ml-auto mr-auto rounded-lg">
      <div class="deleteHeader flex flex-row w-full h-8 border-b border-slate-200 gap-4">
        <div class="my-1 ml-4 w-full h-full font-bold">Project deletion</div>
        <div class="ml-auto mt-1 mr-1 flex h-fit w-fit px-1 py-1 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="cancelProjectDeletion()"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>
      </div>
      <div class="w-full py-2 px-4 h-fit text-sm">Are you sure you want to delete this project? You will lose all data.</div>
      <div class="flex flex-row gap-2 py-2 ml-auto mr-2">
        <div class="w-fit h-fit px-3 py-1 bg-slate-100 border border-slate-200 hover:bg-slate-300 rounded-lg cursor-pointer" onclick="cancelProjectDeletion()">Cancel</div>
        <div class="w-fit h-fit px-3 py-1 bg-slate-500 border border-slate-400 hover:bg-slate-600 rounded-lg cursor-pointer text-slate-50" onclick="confirmProjectDelete('${id}')">Delete</div>
      </div>
    </div>
  </div>
  `
  );
}

function confirmProjectDelete(id) {
  $.post("../utils/scripts/deleteProject.php", {
    projectID: id,
  }).done((data) => {
    window.location.reload();
  });
}

function cancelProjectDeletion() {
  const getOverlay = document.getElementById("projectDeletionOverlay");
  if (getOverlay != null) {
    getOverlay.remove();
  }
}

function saveProjectChanges(id) {
  let newProjectName = document.getElementById("projectNameEdit").value;
  let newProjectDescription = document.getElementById(
    "projectDescriptionEdit"
  ).value;
  const newColorName = document.getElementById("currentColorName").innerText;

  let finalName = newProjectName == "" ? "Project" : newProjectName;
  let finalDescription = newProjectDescription == "" ? "" : newProjectDescription;

  postUpdateProject(finalName, finalDescription, newColorName, id);
}

function cancelProjectEdit() {
  const getOverlay = document.getElementById("projectEditOverlay");
  if (getOverlay != null) {
    getOverlay.remove();
  }
}

function saveColumnChanges(boardID) {
  let projectID = getProjectIdFromBoardId(boardID);
  let newBoardName = document.getElementById("columnNameEdit").value;
  const newBoardDescription = document.getElementById(
    "columnDescriptionEdit"
  ).value;
  if (newBoardName == "" || newBoardName == null) newBoardName = "Column";
  $.post("../utils/scripts/saveColumnEdit.php", {
    boardID,
    board_name: newBoardName,
    board_description: newBoardDescription,
  }).done((data) => {
    cancelColumnEdit();
    reloadBoardData(projectID);
  });
}

function addNewTask(boardID) {
  resetAllNewTasks();
  /* Getting the board ID, confirm button, cancel button and existing tasks. */
  const board = document.getElementById(`${boardID}_name`);
  const existingTasks = document.querySelectorAll(
    `[class*='board_${boardID}']`
  );
  /* Inserting a temporary task into the board. */
  board.insertAdjacentHTML(
    "beforeend",
    `
    <div id="board_${boardID}_edit" class="flex flex-col edit gap-2">
    <div class="w-full h-fit mt-1 bg-slate-200 flex-col border border-slate-400 rounded-md">
      <textarea id="task_${boardID}_edit" maxlength="64" class="border-b border-slate-300 flex mt-[0.2px] form-control h-8 resize-none bg-transparent overflow-y-hidden pt-1 pl-2 w-full focus:text-slate-700 focus:bg-slate-50 focus:rounded-tr-md focus:rounded-tl-md focus:border focus:outline-none focus:border-slate-600">Task #${
      existingTasks.length + 1
    }</textarea>
      <input id="dueTo" class="flex w-full mt-0.5 mx-[0.1px] form-control px-4 bg-transparent focus:text-slate-700 border-b border-slate-300 focus:bg-slate-50 focus:border focus:outline-none focus:border-slate-600" type="date"></input>
      <div class="flex flex-row w-full h-8">
        <div title="Add priority" id="priorityButton" class="flex ml-1 my-1 h-fit w-fit px-1 py-1 hover:bg-slate-300 rounded-lg cursor-pointer" onclick="showPriorityList()">
          <svg class="flex w-4 h-4 fill-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M48 24C48 10.7 37.3 0 24 0S0 10.7 0 24V64 350.5 400v88c0 13.3 10.7 24 24 24s24-10.7 24-24V388l80.3-20.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30V66.1c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L48 52V24zm0 77.5l96.6-24.2c27-6.7 55.5-3.6 80.4 8.8c54.9 27.4 118.7 29.7 175 6.8V334.7l-24.4 9.1c-33.7 12.6-71.2 10.7-103.4-5.4c-48.2-24.1-103.3-30.1-155.6-17.1L48 338.5v-237z"/></svg>
        </div>
        <div id="priorityList" class="flex w-fit ml-4 h-fit my-1 rounded-lg border border-transparent bg-transparent" onclick="showPriorityList()">
          <div id="priorityListText" class="flex mx-auto px-2 cursor-pointer"></div>
        </div>
      </div>
    </div>
    <div class="flex flex-row gap-2">
    <div class="flex h-8 w-full bg-red-400 hover:bg-red-500 rounded-md cursor-pointer" onclick="cancelChanges('${boardID}')">
      <div class="flex mx-auto my-auto">Cancel</div>
    </div>
      <div class="flex h-8 w-full bg-lime-400 hover:bg-lime-500 rounded-md cursor-pointer" onclick="saveData('${boardID}')">
        <div class="flex mx-auto my-auto">Add</div>
      </div>
    </div>
    </div>
    `
  );
  const addNewTaskButton = document.getElementById(`${boardID}_add`);
  addNewTaskButton.classList.add("hidden");
  /* Focusing and select the the last input element. */
  const input = document.getElementById(`task_${boardID}_edit`);
  setTimeout(() => {
    input.focus();
    input.select();
  }, 0);
}

function saveData(boardID) {
  let projectID = getProjectIdFromBoardId(boardID);
  /* Getting all the task names from the input fields. */
  const getDate = document.getElementById("dueTo").value;
  const taskName = document.getElementById(`task_${boardID}_edit`).value;
  const priority = document.getElementById("priorityListText").innerText;
  cancelChanges(boardID);
  /*Adding the tasks to the database.  */
  setTimeout(() => {
    $.post("../utils/scripts/addNewTask.php", {
      boardID,
      nameOfTask: taskName,
      date: getDate,
      priority,
    }).done((data) => {
      reloadBoardData(projectID);
    });
  }, 20);
}

function cancelChanges(boardID) {
  /* Removing the input fields. */
  document.getElementById(`board_${boardID}_edit`).remove();
  const addNewTaskButton = document.getElementById(`${boardID}_add`);
  addNewTaskButton.classList.remove("hidden");
}

function isChecked(taskID, projectName) {
  /* Getting the state of the checkbox and then updating it. */
  let state = getCheckState(taskID);
  const changedState = state == 1 ? 0 : 1;
  /* Updating the state of the checkbox. */
  $.post("../utils/scripts/updateCheckboxState.php", {
    state: changedState,
    dataID: taskID,
  }).done((data) => {
    reloadBoardData(projectName);
  });
}

$(document).keyup((e) => {
  if (e.key === "Escape") {
    resetAllNewTasks();
    if ($(".newBoard").hasClass("h-20")) {
      expandBoardCreate();
    }
  }
});

const mouse = { x: 0, y: 0 };
document.addEventListener("mousemove", (e) => {
  mouse.x = e.clientX;
  mouse.y = e.clientY;
});

function cancelOverlay(overlayName) {
  const getOverlay = document.getElementById(overlayName);
  if (getOverlay != null) {
    getOverlay.remove();
  }
}

const closePriorityModalWindowOnBlur = (e) => {
  if (e.target === e.currentTarget) cancelOverlay("priorityListOverlay");
};

const closeTaskModalWindowOnBlur = (e) => {
  if (e.target === e.currentTarget) cancelOverlay("taskManageOverlay");
};

const closeTaskDeleteModalWindowOnBlur = (e) => {
  if (e.target === e.currentTarget) cancelOverlay("taskDeletionOverlay");
};

const closeTaskEditModalWindowOnBlur = (e) => {
  if (e.target === e.currentTarget) cancelOverlay("taskEditOverlay");
};

const closeColumnEditModalWindowOnBlur = (e) => {
  if (e.target === e.currentTarget) cancelOverlay("columnEditOverlay");
};

const closeProjectEditModalWindowOnBlur = (e) => {
  if (e.target === e.currentTarget) cancelOverlay("projectEditOverlay");
};
