/**
 * It gets the project ID from the database, then adds a new board to the database.
 * @param projectName - The name of the project that the board is being added to.
 */
function addBoard(projectName) {
  /* Getting the project ID from the database. */
  const projectID = $.ajax("../utils/scripts/getProjectID.php", {
    async: false,
    type: "post",
    data: {
      project_name: projectName.id,
    },
  });

  const newProjectName = document.getElementById("newBoardInput").value;
  if (newProjectName.length > 0) {
    /* Adding a new board to the database. */
    $.post("../utils/scripts/addNewBoard.php", {
      projectID: projectID.responseText,
      board_name: newProjectName,
      board_description: "",
    }).done((data) => {
      reloadBoardData(projectName.id);
    });
  } else {
    /* Adding a new board to the database. */
    $.post("../utils/scripts/addNewBoard.php", {
      projectID: projectID.responseText,
      board_name: "Column",
      board_description: "",
    }).done((data) => {
      reloadBoardData(projectName.id);
    });
  }
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

function reloadBoardData(projectName) {
  /* Reloading the board data. */
  document.getElementById("boards").innerText = "";
  const board = $.ajax("../utils/loadBoards.php", {
    async: false,
    type: "post",
    data: {
      project_name: projectName,
    },
  });
  const getBoardArea = document.getElementById("boards");
  getBoardArea.insertAdjacentHTML("afterbegin", board.responseText);
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
  const list = $.ajax("../utils/loadPriorityList.php", {
    async: false,
    type: "post",
  });
  body.insertAdjacentHTML("beforeend", list.responseText);
  const priorityPopup = document.getElementById("priorityListPopup");
  priorityPopup.classList.add(`left-[${mouse.x + 4}px]`);
  priorityPopup.classList.add(`top-[${mouse.y + 4}px]`);
  priorityPopup.classList.toggle('beforeShowUp');
  priorityPopup.classList.toggle('afterShowUp');
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

function showTaskManagePopup(dataID, projectName) {
  closeTaskManagePopup();
  const manage = $.ajax("../utils/loadTaskManage.php", {
    async: false,
    type: "post",
    data: {
      dataID: dataID,
      projectName: projectName
    }
  });
  body.insertAdjacentHTML("beforeend", manage.responseText);
  const taskManagePopup = document.getElementById("taskManagePopup");
  taskManagePopup.classList.add(`left-[${mouse.x + 4}px]`);
  taskManagePopup.classList.add(`top-[${mouse.y + 4}px]`);
  taskManagePopup.classList.toggle('beforeShowUp');
  taskManagePopup.classList.toggle('afterShowUp');
  const taskModal = document.getElementById("taskManageOverlay");
  taskModal.addEventListener("click", closeTaskModalWindowOnBlur);

}

function closeTaskManagePopup() {
  const findTaskManagePopup = document.getElementById("taskManageOverlay");
  if (findTaskManagePopup != null) {
    findTaskManagePopup.remove();
  }
}

function deleteTask(taskID, projectName) {
  closeTaskManagePopup();
  body.insertAdjacentHTML('beforeend',
  `
  <div id="taskDeletionOverlay" class="flex w-screen h-screen absolute bg-white/25">
    <div class="flex flex-col w-80 h-fit top-28 bg-slate-50 shadow-xl absolute left-1/2 rounded-lg">
      <div class="deleteHeader flex flex-row w-full h-8 border-b border-slate-200 gap-4">
        <div class="my-1 ml-4 w-full h-full font-bold">Task deletion</div>
        <div class="ml-auto mt-1 mr-1 flex h-fit w-fit px-1 py-1 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="cancelTaskDeletion()"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>
      </div>
      <div class="w-full py-2 px-4 h-fit text-sm">Are you sure you want to delete this task?</div>
      <div class="flex flex-row gap-2 py-2 ml-auto mr-2">
        <div class="w-fit h-fit px-3 py-1 bg-slate-100 border border-slate-200 hover:bg-slate-300 rounded-lg cursor-pointer" onclick="cancelTaskDeletion()">Cancel</div>
        <div class="w-fit h-fit px-3 py-1 bg-slate-500 border border-slate-400 hover:bg-slate-600 rounded-lg cursor-pointer text-slate-50" onclick="confirmTaskDelete(${taskID}, ${projectName})">Delete</div>
      </div>
    </div>
  </div>
  `)
  const taskDeleteModal = document.getElementById("taskDeletionOverlay");
  taskDeleteModal.addEventListener("click", closeTaskDeleteModalWindowOnBlur);
}

function cancelTaskDeletion() { 
  const getOverlay = document.getElementById("taskDeletionOverlay");
  if (getOverlay != null) {
    getOverlay.remove();
  }
}

function confirmTaskDelete(taskID, projectName) {
  $.post("../utils/scripts/deleteTask.php", {
    taskID: taskID,
  }).done(data => {
    cancelTaskDeletion();
    reloadBoardData(projectName);
  });
}

function showTaskEditPopup() {
  closeTaskManagePopup();
  const edit = $.ajax("../utils/loadTaskEditPopup.php", {
    async: false,
    type: "post",
  }).done(data => {
    console.log(data);
  });
  body.insertAdjacentHTML("beforeend", edit.responseText);
  const taskEditPopup = document.getElementById("taskEditPopup");
  console.log(taskEditPopup);
  taskEditPopup.classList.toggle('beforeShowUp');
  taskEditPopup.classList.toggle('afterShowUp');
  const editTaskModal = document.getElementById("taskEditOverlay");
  editTaskModal.addEventListener("click", closeTaskEditModalWindowOnBlur);
}

function cancelOverlay(overlayName) { 
  const getOverlay = document.getElementById(overlayName);
  if (getOverlay != null) {
    getOverlay.remove();
  }
}


function addNewTask(boardID) {
  resetAllNewTasks();
  /* Getting the board ID, confirm button, cancel button and existing tasks. */
  const board = document.getElementById(`${boardID}_name`);
  const confirmButton = document.getElementById(`${boardID}_confirm`);
  const cancelButton = document.getElementById(`${boardID}_cancel`);
  var existingTasks = document.querySelectorAll(`[class*='board_${boardID}']`);
  /* Inserting a temporary task into the board. */
  board.insertAdjacentHTML(
    "beforeend",
    `
    <div class="board_${boardID}_edit edit w-full h-fit mt-1 bg-slate-200 flex-col border border-slate-400 rounded-md">
      <textarea maxlength="64" class="task_${boardID}_edit border-b border-slate-300 flex mt-[0.2px] form-control h-8 resize-none bg-transparent overflow-y-hidden pt-1 pl-2 w-full focus:text-slate-700 focus:bg-slate-50 focus:rounded-tr-md focus:rounded-tl-md focus:border focus:outline-none focus:border-slate-600">Task #${
      existingTasks.length + 1
    }</textarea>
      <input class="dueTo flex w-full mt-0.5 mx-[0.1px] form-control px-4 bg-transparent focus:text-slate-700 border-b border-slate-300 focus:bg-slate-50 focus:border focus:outline-none focus:border-slate-600" type="date"></input>
      <div class="flex flex-row w-full h-8">
        <div title="Add priority" id="priorityButton" class="flex ml-1 my-1 h-fit w-fit px-1 py-1 hover:bg-slate-300 rounded-lg cursor-pointer" onclick="showPriorityList()">
          <svg class="flex w-4 h-4 fill-black"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 64c0-17.7-14.3-32-32-32S32 46.3 32 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM64 480c22.1 0 40-17.9 40-40s-17.9-40-40-40s-40 17.9-40 40s17.9 40 40 40z"/></svg>
        </div>
        <div id="priorityList" class="flex w-fit ml-4 h-fit my-1 rounded-lg border border-transparent bg-transparent" onclick="showPriorityList()">
          <div id="priorityListText" class="flex mx-auto px-2 cursor-pointer"></div>
        </div>
      </div>
    </div>
    `
  );
  const addNewTaskButton = document.getElementById(`${boardID}_add`);
  addNewTaskButton.classList.add("hidden");
  /* Checking if there are any tasks that are being edited. If there are, it will show the confirm and
  cancel buttons. */
  var existingTasks = document.querySelectorAll(
    `[class*='board_${boardID}_edit']`
  );
  if (existingTasks.length > 0) {
    confirmButton.classList.remove("hidden");
    cancelButton.classList.remove("hidden");
  }
  /* Focusing and select the the last input element. */
  const input = document.getElementsByClassName(`task_${boardID}_edit`);
  setTimeout(() => {
    input[input.length - 1].focus();
    input[input.length - 1].select();
  }, 0);
}

function saveData(boardID, projectName) {
  /* Getting all the task names from the input fields. */
  const taskNames = [];
  const confirmButton = document.getElementById(`${boardID}_confirm`);
  const cancelButton = document.getElementById(`${boardID}_cancel`);
  const getDate = document.getElementsByClassName("dueTo");
  const date = getDate[0].value;
  const existingTasks = document.getElementsByClassName(`task_${boardID}_edit`);
  const priority = document.getElementById("priorityListText").innerText;
  /* Getting all the task names from the input fields. */
  for (const existingTask of existingTasks) {
    taskNames.push(existingTask.value);
  }
  /* Hiding the confirm and cancel buttons. */
  confirmButton.classList.add("hidden");
  cancelButton.classList.add("hidden");
  /* Adding the tasks to the database. */
  setTimeout(() => {
    for (const taskName of taskNames) {
      $.post("../utils/scripts/addNewTask.php", {
        boardID: boardID,
        nameOfTask: taskName,
        date: date,
        priority: priority,
      }).done((data) => {
        console.log(data);
        reloadBoardData(projectName);
      });
    }
  }, 20);
}

function cancelChanges(boardID) {
  /* Removing the input fields. */
  const findAllEditTasks = document.getElementsByClassName(
    `board_${boardID}_edit`
  );
  const cancelButton = document.getElementById(`${boardID}_cancel`);
  const confirmButton = document.getElementById(`${boardID}_confirm`);
  const addNewTaskButton = document.getElementById(`${boardID}_add`);
  while (findAllEditTasks.length > 0) {
    findAllEditTasks[0].remove();
  }
  confirmButton.classList.add("hidden");
  cancelButton.classList.add("hidden");
  addNewTaskButton.classList.remove("hidden");
}

function isChecked(taskID, projectName) {
  /* Getting the state of the checkbox and then updating it. */
  const state = $.ajax("../utils/scripts/getCheckStatus.php", {
    async: false,
    type: "POST",
    data: {
      dataID: taskID,
    },
  }).done((data) => {
    return data;
  });
  const changedState = state.responseText == 1 ? 0 : 1;
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

const closePriorityModalWindowOnBlur = (e) => {
  if (e.target === e.currentTarget) cancelOverlay("priorityListOverlay");
};

const closeTaskModalWindowOnBlur = (e) => {
  if (e.target === e.currentTarget) cancelOverlay("taskManageOverlay");
}
;
const closeTaskDeleteModalWindowOnBlur = (e) => {
  if (e.target === e.currentTarget) cancelOverlay("taskDeleteOverlay");
};

const closeTaskEditModalWindowOnBlur = (e) => {
  if (e.target === e.currentTarget) cancelOverlay("taskEditOverlay");
};
