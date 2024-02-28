class BoardManager {
  updateBoard(id) {
    let popupHandler = new PopupHandler();
    popupHandler.closeAnyPopup();
    $("#boards").text("");
    $("#boards").prepend(getBoardData(id));
  }

  addBoard(projectID) {
    const newBoardName = $("#newBoardInput").val();
    if (!newBoardName.replace(/\s/g, "").length) return;
    let log = new LogManager(projectID, null, this.boardID);
    log.logNewColumn(newBoardName);
    $.post("https://xtodolist.tode.cz/src/scripts/board/addNewBoard.php", {
      projectID: projectID,
      board_name: newBoardName,
    })
      .done((data) => this.updateBoard(projectID))
      .fail((error) => {
        console.error(`Request failed with error: ${error}`);
      });
  }

  expandNewBoard() {
    classToggle(document.getElementsByClassName("newBoard")[0], "h-8", "h-20", "bg-slate-100");
    classToggle(document.getElementsByClassName("newBoardButton")[0], "w-64", "w-[13rem]", "hidden");
    classToggle(document.getElementsByClassName("acceptNewBoard")[0], "w-64", "w-[13rem]", "hidden");
    $(".newBoardCancel").toggleClass("hidden");

    document.querySelector("#newBoardInput").classList.toggle("hidden");
    setTimeout(() => {
      document.querySelector("#newBoardInput").focus();
      document.querySelector("#newBoardInput").select();
    }, 0);
  }

  resetAllNewTasks() {
    const existingTasks = document.querySelectorAll(`div.edit`);
    const addNewTaskButton = document.querySelectorAll(`[id*='_add']`);

    for (var i = 0; i < addNewTaskButton.length; i++) {
      addNewTaskButton[i].classList.remove("hidden");
    }

    for (var i = 0; i < existingTasks.length; i++) {
      existingTasks[i].remove();
    }
  }

  savePriority(priorityID, name) {
    let priorityPopup = new PriorityPopup();
    priorityPopup.closePriority();
    const PRIORITY_COLORS = {
      1: "bg-red-100",
      2: "bg-amber-100",
      3: "bg-slate-100",
      4: "bg-transparent",
    };

    const color = PRIORITY_COLORS[priorityID];
    const prioritySel = document.getElementById("priorityList");
    for (let i = 0; i < 2; i++) {
      prioritySel.classList.remove(prioritySel.classList.toString().split(" ").pop());
    }
    prioritySel.classList.add(color);
    const priorityName = document.getElementById("priorityListText");
    if (priorityID == 4) {
      prioritySel.classList.add("border-transparent");
      priorityName.innerText = "";
      priorityName.setAttribute("data-priority-id", 4);
    } else {
      prioritySel.classList.add("border-slate-300");
      priorityName.innerText = name;
      priorityName.setAttribute("data-priority-id", priorityID);
    }
  }

  moveTask(boardID, dataID) {
    let projectID = getProjectIdFromBoardId(boardID);
    let popupHandler = new PopupHandler();
    popupHandler.closeAnyPopup();
    let log = new LogManager(projectID, dataID, boardID);
    log.logTaskMove(getBoardNameFromTaskId(dataID), getBoardNameFromBoardId(boardID), getTaskNameFromTaskId(dataID));
    $.post("https://xtodolist.tode.cz/src/scripts/task/moveToAnotherBoard.php", {
      boardID: boardID,
      dataID: dataID,
    }).done((data) => {
      this.updateBoard(projectID);
    });
  }

  saveEditedTask(boardId, dataId) {
    const projectId = getProjectIdFromBoardId(boardId);
    const newTaskName = $("#taskNameEdit").val();
    const newTaskDescription = $("#taskDescriptionEdit").val();
    const newDueTo = $("#taskDueToEdit").val();
    const newPriority = $("#priorityListText").data("priority-id");
    if (!newTaskName.replace(/\s/g, "").length) {
      $("#taskNameEdit").addClass("border-red-500");
      return;
    }
    const finalTaskDescription = newTaskDescription || "";
    const finalDueTo = newDueTo || "0000-00-00";
    const finalPriority = newPriority || 4;

    const log = new LogManager(projectId, dataId, boardId);
    $.post("https://xtodolist.tode.cz/src/scripts/task/saveTaskEdit.php", {
      dataID: dataId,
      task_name: newTaskName,
      task_description: finalTaskDescription,
      task_dueTo: finalDueTo,
      task_priority: finalPriority,
    }).done((data) => {
      this.updateBoard(projectId);
    });
    const taskName = getTaskNameFromTaskId(dataId);
    const boardName = getBoardNameFromBoardId(boardId);
    log.logTaskUpdate(taskName, boardName, newTaskName);
  }

  updateCheckbox(dataID) {
    let popupHandler = new PopupHandler();
    popupHandler.closeAnyPopup();
    classToggle(document.getElementById(dataID), "border-gray-300", "bg-slate-50", "border-lime-600", "bg-lime-500");
    classToggle(document.getElementById(dataID + "_check"), "fill-gray-300", "fill-white");
    classToggle(document.getElementById(dataID + "_taskChecked"), "opacity-70");
    $.post("https://xtodolist.tode.cz/src/scripts/task/updateCheckboxState.php", {
      dataID: dataID,
    });
  }

  saveTask(boardID) {
    var taskName = document.getElementById(`task_${boardID}_edit`).value;
    if (!taskName.replace(/\s/g, "").length)
      return $(`#task_${boardID}_edit`).addClass("border border-red-500 rounded-tl-md rounded-tr-md");
    let log = new LogManager(getProjectIdFromBoardId(boardID), null, boardID);
    $.post("https://xtodolist.tode.cz/src/scripts/task/addNewTask.php", {
      boardID: boardID,
      nameOfTask: taskName.trim(),
      date: $("#dueTo").val(),
      priorityID: $("#priorityListText").data("priority-id"),
    }).done((data) => {
      setTimeout(() => {
        this.updateBoard(getProjectIdFromBoardId(boardID));
      }, 20);
    });
    log.logNewTask(taskName, getBoardNameFromBoardId(boardID));
  }

  saveEditedColumn(boardID) {
    let projectID = getProjectIdFromBoardId(boardID);
    let newBoardName = document.getElementById("columnNameEdit").value;
    const newBoardDescription = document.getElementById("columnDescriptionEdit").value;
    if (!newBoardName.replace(/\s/g, "").length) return $("#columnNameEdit").addClass("!border-red-500");
    let log = new LogManager(projectID, null, boardID);
    $.post("https://xtodolist.tode.cz/src/scripts/board/saveColumnEdit.php", {
      boardID: boardID,
      board_name: newBoardName,
      board_description: newBoardDescription,
    }).done((data) => this.updateBoard(projectID));
    log.logColumnUpdate(getBoardNameFromBoardId(boardID), newBoardName);
  }

  cancelTaskAdding(boardID) {
    document.getElementById(`board_${boardID}_edit`).remove();
    const addNewTaskButton = document.getElementById(`${boardID}_add`);
    addNewTaskButton.classList.remove("hidden");
  }

  addNewTaskForm(boardID) {
    this.resetAllNewTasks();
    const board = document.getElementById(`${boardID}_name`);
    board.insertAdjacentHTML("beforeend", getAddNewTask(boardID, board.children.length));
    const addNewTaskButton = document.getElementById(`${boardID}_add`);
    addNewTaskButton.classList.add("hidden");
  }
}
