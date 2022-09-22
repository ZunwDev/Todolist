function addBoard(projectName) {
  /* Getting the project ID from the database. */
  var projectID = $.ajax("../utils/scripts/getProjectID.php", {
    async: false,
    type: "post",
    data: {
      project_name: projectName.id,
    },
  });

  /* Adding a new board to the database. */
  $.post("../utils/scripts/addNewBoard.php", {
    projectID: projectID.responseText,
    board_name: "Column",
    board_description: "",
  }).done(function (data) {
    reloadBoardData(projectName.id);
  });
}

function reloadBoardData(projectName) {
  /* Reloading the board data. */
  document.getElementById("boards").innerText = "";
  var board = $.ajax("../utils/loadBoards.php", {
    async: false,
    type: "post",
    data: {
      project_name: projectName,
    },
  });
  let getBoardArea = document.getElementById("boards");
  getBoardArea.insertAdjacentHTML("afterbegin", board.responseText);
}

function addNewTask(boardID) {
  /* Getting the board ID, confirm button, cancel button and existing tasks. */
  var board = document.getElementById(boardID + "_name");
  var confirmButton = document.getElementById(boardID + "_confirm");
  var cancelButton = document.getElementById(boardID + "_cancel");
  var existingTasks = document.querySelectorAll(`[class*='board_${boardID}']`);
  /* Inserting a temporary task into the board. */
  board.insertAdjacentHTML(
    "beforeend",
    `<div class="board_${boardID}_edit w-full h-8 mt-0.5 bg-slate-200 flex-row">
            <textarea maxlength="64" class="task_${boardID}_edit flex form-control h-full resize-none bg-transparent overflow-y-hidden pt-1 pl-2 w-full focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600">Task #${
      existingTasks.length + 1
    }</textarea>
        </div>
    `
  );
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
  let input = document.getElementsByClassName(`task_${boardID}_edit`);
  setTimeout(function () {
    input[input.length - 1].focus();
    input[input.length - 1].select();
  }, 0);
}

function saveAllAtOnce(boardID, projectName) {
  /* Getting all the task names from the input fields. */
  var taskNames = [];
  var confirmButton = document.getElementById(boardID + "_confirm");
  var cancelButton = document.getElementById(boardID + "_cancel");
  let existingTasks = document.getElementsByClassName(`task_${boardID}_edit`);
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
    }).done(function (data) {
      reloadBoardData(projectName);
    });
  }
}

function cancelChanges(boardID) {
  /* Removing the input fields. */
  var findAllEditTasks = document.getElementsByClassName(
    `board_${boardID}_edit`
  );
  var cancelButton = document.getElementById(boardID + "_cancel");
  var confirmButton = document.getElementById(boardID + "_confirm");
  while (findAllEditTasks.length > 0) {
    findAllEditTasks[0].remove();
  }
  confirmButton.classList.add("hidden");
  cancelButton.classList.add("hidden");
}

function isChecked(taskID, projectName) {
  /* Getting the state of the checkbox and then updating it. */
  var state = $.ajax("../utils/scripts/getCheckStatus.php", {
    async: false,
    type: "POST",
    data: {
      dataID: taskID,
    },
  }).done(function (data) {
    return data;
  });
  if (state.responseText == 1) {
    state = 0;
  } else {
    state = 1;
  }
  $.post("../utils/scripts/updateCheckboxState.php", {
    state: state,
    dataID: taskID,
  }).done(function (data) {
    reloadBoardData(projectName);
  });
}
