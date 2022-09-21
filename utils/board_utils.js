function addBoard(projectName) {
  var findProjectID = document.querySelectorAll(`section[id$='_id']`);
  var projectID = findProjectID[0].id.slice(
    0,
    findProjectID[0].id.indexOf("_")
  );

  $.post("../utils/scripts/addNewBoard.php", {
    projectID: projectID,
    board_name: "Column",
    board_description: "",
  }).done(function (data) {
    reloadBoardData(projectName);
  });
}

function reloadBoardData(projectName) {
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
  //Data
  var board = document.getElementById(boardID + "_name");
  var confirmButton = document.getElementById(boardID + "_confirm");
  var cancelButton = document.getElementById(boardID + "_cancel");
  var existingTasks = document.querySelectorAll(`[class*='board_${boardID}']`);
  //Inserting new task
  board.insertAdjacentHTML(
    "beforeend",
    `<div class="board_${boardID}_edit w-full h-8 mt-0.5 bg-slate-200 flex-row">
            <textarea class="task_${boardID}_edit flex form-control h-full resize-none bg-transparent overflow-y-hidden pt-1 pl-2 w-full focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600">Task #${
      existingTasks.length + 1
    }</textarea>
        </div>
    `
  );
  //Showing confirm button
  var existingTasks = document.querySelectorAll(
    `[class*='board_${boardID}_edit']`
  );
  if (existingTasks.length > 0) {
    confirmButton.classList.remove("hidden");
    cancelButton.classList.remove("hidden");
  }
  //Focus & select input
  let input = document.getElementsByClassName(`task_${boardID}_edit`);
  setTimeout(function () {
    input[input.length - 1].focus();
    input[input.length - 1].select();
  }, 0);
}

function saveAllAtOnce(boardID, projectName) {
  //Data
  var taskNames = [];
  var confirmButton = document.getElementById(boardID + "_confirm");
  var cancelButton = document.getElementById(boardID + "_cancel");
  let existingTasks = document.getElementsByClassName(`task_${boardID}_edit`);
  //Getting all task names
  for (var i = 0; i < existingTasks.length; i++) {
    taskNames.push(existingTasks[i].value);
  }
  console.log(taskNames);
  //Hiding confirm button
  confirmButton.classList.add("hidden");
  cancelButton.classList.add("hidden");
  //Adding to database
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

function isChecked(taskName, taskID, projectName) {
  var state = document.getElementById("checkbox_" + taskName).checked;
  console.log(state);
  if (state === true) {
    console.log("a");
    $.post("../utils/scripts/updateCheckboxState.php", {
      state: 1,
      dataID: taskID,
    }).done(function (data) {
    });
    reloadBoardData(projectName);
  } else {
    $.post("../utils/scripts/updateCheckboxState.php", {
      state: 0,
      dataID: taskID,
    }).done(function (data) {
    });
    reloadBoardData(projectName);
  }
}
