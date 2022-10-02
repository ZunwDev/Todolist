function addBoard(projectName) {
  /* Getting the project ID from the database. */
  const projectID = $.ajax("../utils/scripts/getProjectID.php", {
    async: false,
    type: "post",
    data: {
      project_name: projectName,
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
      reloadBoardData(projectName);
    });
  } else {
    /* Adding a new board to the database. */
    $.post("../utils/scripts/addNewBoard.php", {
      projectID: projectID.responseText,
      board_name: "Column",
      board_description: "",
    }).done((data) => {
      reloadBoardData(projectName);
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
  $(".newBoardButton").toggleClass("w-56");
  $(".newBoardButton").toggleClass("w-[11rem]");
  $(".acceptBoard").toggleClass("w-56");
  $(".acceptBoard").toggleClass("w-[11rem]");
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
    `<div class="board_${boardID}_edit edit w-full h-8 mt-0.5 bg-slate-200 flex-row">
            <textarea maxlength="64" class="task_${boardID}_edit flex form-control h-full resize-none bg-transparent overflow-y-hidden pt-1 pl-2 w-full focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600">Task #${
      existingTasks.length + 1
    }</textarea>
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
  const existingTasks = document.getElementsByClassName(`task_${boardID}_edit`);
  /* Getting all the task names from the input fields. */
  for (var i = 0; i < existingTasks.length; i++) {
    taskNames.push(existingTasks[i].value);
  }
  /* Hiding the confirm and cancel buttons. */
  confirmButton.classList.add("hidden");
  cancelButton.classList.add("hidden");
  /* Adding the tasks to the database. */
  for (var i = 0; i < taskNames.length; i++) {
    $.post("../utils/scripts/addNewTask.php", {
      boardID: boardID,
      nameOfTask: taskNames[i],
    }).done((data) => {
      reloadBoardData(projectName);
    });
  }
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
