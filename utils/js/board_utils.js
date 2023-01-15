/* Getting the project ID from the database. */
function addBoard(id) {
  const newProjectName = document.getElementById('newBoardInput').value;
  let finalProjectName = newProjectName.length > 0 ? newProjectName : 'Column';
  /* Adding a new board to the database. */
  $.post('../utils/scripts/board/addNewBoard.php', {
    projectID: id,
    board_name: finalProjectName,
  }).done((data) => reloadBoardData(id));
}

function popupModalSettings(listener, overlay) {
  const getPopup = document.getElementById('popupElement');
  classToggle(getPopup, 'beforeShowUp', 'afterShowUp');
  const popupOverlay = document.getElementById(overlay);
  popupOverlay.addEventListener('pointerdown', listener);
}

/**
 * When the user clicks the button, the button expands and a text input appears
 */
function expandBoardCreate() {
  classToggle(document.getElementsByClassName('newBoard')[0], 'h-8', 'h-20', 'bg-slate-100');
  classToggle(document.getElementsByClassName('newBoardButton')[0], 'w-64', 'w-[13rem]');
  classToggle(document.getElementsByClassName('acceptBoard')[0], 'w-64', 'w-[13rem]');
  $('.newBoardButton').toggleClass('hidden');
  $('.acceptBoard').toggleClass('hidden');
  $('.newBoardCancel').toggleClass('hidden');

  let input = document.getElementById('newBoardInput');
  input.classList.toggle('hidden');
  setTimeout(() => {
    input.focus();
    input.select();
  }, 0);
}

function reloadBoardData(id) {
  closeAnyPopup();
  /* Reloading the board data. */
  document.getElementById('boards').innerText = '';
  const getBoardArea = document.getElementById('boards');
  getBoardArea.insertAdjacentHTML('afterbegin', getBoardData(id));
}

/**
 * This function hides the confirm and cancel buttons, shows the add new task button, and removes all
 * existing tasks.
 */
function resetAllNewTasks() {
  const existingTasks = document.querySelectorAll(`div.edit`);
  const addNewTaskButton = document.querySelectorAll(`[id*='_add']`);

  for (var i = 0; i < addNewTaskButton.length; i++) {
    addNewTaskButton[i].classList.remove('hidden');
  }

  for (var i = 0; i < existingTasks.length; i++) {
    existingTasks[i].remove();
  }
}

function showPriorityList() {
  let priorityList = getPriorityListPopup();

  body.insertAdjacentHTML('beforeend', priorityList);
  const popup = document.getElementById('popupElementPriority');
  popup.classList.add(`left-[${mouse.x + 8}px]`, `top-[${mouse.y - 128}px]`);
  classToggle(popup, 'beforeShowUp', 'afterShowUp');
  const popupOverlay = document.getElementById('popupOverlayPriority');
  popupOverlay.addEventListener('click', closeModalPriority);
}

function showMoveToPopup(dataID) {
  let moveToList = getMoveToPopup(dataID);

  body.insertAdjacentHTML('beforeend', moveToList);
  const popup = document.getElementById('popupPopupElement');
  popup.classList.add(`left-[${mouse.x + 64}px]`, `top-[${mouse.y - 128}px]`);
  classToggle(popup, 'beforeShowUp', 'afterShowUp');
  const popupOverlay = document.getElementById('popupPopupOverlay');
  popupOverlay.addEventListener('click', closeModalMoveTo);
}

function savePriority(name) {
  closePriority();
  let colors = {
    High: 'bg-red-100',
    Medium: 'bg-amber-100',
    Low: 'bg-slate-100',
    None: 'bg-transparent',
  };

  const color = colors[name];
  const prioritySel = document.getElementById('priorityList');
  for (let i = 0; i < 2; i++) {
    prioritySel.classList.remove(prioritySel.classList.toString().split(' ').pop());
  }
  prioritySel.classList.add(color);
  const priorityName = document.getElementById('priorityListText');
  if (name === 'None') {
    prioritySel.classList.add('border-transparent');
    priorityName.innerText = '';
  } else {
    prioritySel.classList.add('border-slate-300');
    priorityName.innerText = name;
  }
}

function setPopupToCorrectPos() {
  let el = document.getElementById('popupElement');
  let diff = document.body.scrollHeight - mouse.y;
  let bheight = document.body.scrollHeight;
  let mdiff = mouse.y + document.body.scrollHeight - diff;

  mdiff > bheight
    ? el.classList.add(`top-[${mouse.y + window.scrollY - 128}px]`)
    : el.classList.add(`top-[${mouse.y + window.scrollY}px]`);
  el.classList.add(`left-[${mouse.x + window.scrollX + 16}px]`);
}

function openPopupUnderButton() {
  let el = document.getElementById('popupElement');
  el.classList.add(`top-[${mouse.y + 32}px]`);
  el.classList.add(`left-[${mouse.x - 64}px]`);
}

function showPopup(htmlString, setPosFunction, closeAnyPopup, modalSettings, overlay = 'popupOverlay') {
  closeAnyPopup();
  body.insertAdjacentHTML('beforeend', htmlString);
  setPosFunction();
  popupModalSettings(modalSettings, overlay);
}

function showTaskManagePopup(dataID) {
  showPopup(getTaskManagePopup(dataID), setPopupToCorrectPos, closeAnyPopup, closeModal);
}

function showColumnManagePopup(boardID) {
  showPopup(getColumnManagePopup(boardID), setPopupToCorrectPos, closeAnyPopup, closeModal);
}

function showTaskEditPopup(dataID) {
  showPopup(getTaskEditPopup(dataID), () => {}, closeAnyPopup, closeModal);
}

function showColumnEdit(boardID) {
  showPopup(getColumnEditPopup(boardID), () => {}, closeAnyPopup, closeModal);
}

function showProjectEdit(id) {
  showPopup(
    getProjectEditPopup(id),
    () => {},
    () => {},
    closeModal
  );
}

function showBoardFilterPopup(projectID) {
  showPopup(
    getBoardFilterPopup(projectID),
    openPopupUnderButton,
    () => {},
    (e) => closeFilterAndSave(e, projectID),
    'popupOverlayFilter'
  );
  //Priority
  let checkmarks = document.querySelectorAll('[id*="_priFil"], [id*="_termFil"], [id*="_taskFil"]');
  let ids = Array.from(checkmarks).map((element) => element.id);
  for (let i = 0; i < localStorage.length; i++) {
    let curItem = localStorage.getItem(ids[i].slice(0, ids[i].indexOf('_')));
    if (curItem == 'true') {
      checkmarks[i].checked = curItem;
    } else {
      checkmarks[i].checked = '';
    }
  }
}

function confirmMoving(boardID, dataID) {
  let projectID = getProjectIdFromBoardId(boardID);
  closeAnyPopup();
  $.post('../utils/scripts/task/moveToAnotherBoard.php', {
    boardID: boardID,
    dataID: dataID,
  }).done((data) => {
    reloadBoardData(projectID);
  });
}

function saveTaskEdit(dataID, boardID) {
  let projectID = getProjectIdFromBoardId(boardID);
  let newTaskName = document.getElementById('taskNameEdit').value;
  let newTaskDescription = document.getElementById('taskDescriptionEdit').value;
  let newDueTo = document.getElementById('taskDueToEdit').value;
  let newPriority = document.getElementById('priorityListText').innerText;
  const board = document.getElementById(`${boardID}_name`);
  if (newTaskName == '') {
    let getTaskAmount = board.children.length - 1 + 1;
    newTaskName = `Task ${getTaskAmount}`;
  }
  let finalTaskDescription = newTaskDescription == '' ? '' : newTaskDescription;
  let finalDueTo = newDueTo == '' ? '0000-00-00' : newDueTo;
  let finalPriority = newPriority == '' ? 'None' : newPriority;

  $.post('../utils/scripts/task/saveTaskEdit.php', {
    dataID,
    task_name: newTaskName,
    task_description: finalTaskDescription,
    task_dueTo: finalDueTo,
    task_priority: finalPriority,
  }).done((data) => {
    setTimeout(() => {
      reloadBoardData(projectID);
    }, 30);
  });
}

function postUpdateProject(projectName, projectDescription, colorName, projectID) {
  $.post('../utils/scripts/project/saveProjectEdit.php', {
    projectName,
    projectDescription,
    color: colorName,
    projectID: projectID,
  }).done((data) => window.location.reload());
}

function showProjectDeleteWarning(id) {
  getDeletePopup(
    id,
    'Project delete',
    'Are you sure you want to delete this project? You will lose all data.',
    'projDel'
  );
}

function showColumnClearWarning(id) {
  getDeletePopup(
    id,
    'Column clear',
    'Are you sure you want to clear this column? You will lose all saved data.',
    'colCl'
  );
}
function showTaskDeleteWarning(id) {
  getDeletePopup(id, 'Task delete', 'Are you sure you want to delete this task?', 'taskDel');
}

function showColumnDeleteWarning(id) {
  getDeletePopup(
    id,
    'Column delete',
    'Are you sure you want to delete this column? You will lose all saved data.',
    'colDel'
  );
}

function confirmDelete(id, delReason) {
  const links = {
    projDel: '../utils/scripts/project/deleteProject.php',
    colCl: '../utils/scripts/board/clearColumn.php',
    colDel: '../utils/scripts/board/deleteColumn.php',
    taskDel: '../utils/scripts/task/deleteTask.php',
  };

  let projectID = (delReason == "taskDel") ? getProjectIdFromTaskId(id) : getProjectIdFromBoardId(id);
  if (delReason == "taskDel") {
    let boardID = getBoardIdFromTaskId(id);
    let log = new Log(projectID, id, boardID);
    log.logRemoveTask(getTaskNameFromTaskId(id), getBoardNameFromTaskId(id));
  }
  if (delReason == "colCl") {
    let log = new Log(projectID, null, id);
    log.logClearColumn(getBoardNameFromBoardId(id));
  }
  if (delReason == "colDel") {
    let log = new Log(projectID, null, id);
    log.logRemoveColumn(getBoardNameFromBoardId(id));
  }
  $.post(links[delReason], {
    id,
  }).done((data) => {
    delReason != 'projDel' ? reloadBoardData(projectID) : window.location.reload();
  });
}

function saveProjectChanges(id) {
  let newProjectName = document.getElementById('projectNameEdit').value;
  let newProjectDescription = document.getElementById('projectDescriptionEdit').value;
  const newColorName = document.getElementById('currentColorName').innerText;

  let finalName = newProjectName == '' ? 'Project' : newProjectName;
  let finalDescription = newProjectDescription == '' ? '' : newProjectDescription;

  postUpdateProject(finalName, finalDescription, newColorName, id);
}

function saveColumnChanges(boardID) {
  let projectID = getProjectIdFromBoardId(boardID);
  let newBoardName = document.getElementById('columnNameEdit').value;
  const newBoardDescription = document.getElementById('columnDescriptionEdit').value;
  if (newBoardName == '' || newBoardName == null) newBoardName = 'Column';
  $.post('../utils/scripts/board/saveColumnEdit.php', {
    boardID,
    board_name: newBoardName,
    board_description: newBoardDescription,
  }).done((data) => reloadBoardData(projectID));
}

function addNewTask(boardID) {
  resetAllNewTasks();
  /* Getting the board ID, confirm button, cancel button and existing tasks. */
  const board = document.getElementById(`${boardID}_name`);
  const existingTasks = board.children.length - 1;
  /* Inserting a temporary task into the board. */
  board.insertAdjacentHTML(
    'beforeend',
    `
    <div id="board_${boardID}_edit" class="flex flex-col edit gap-2">
    <div class="w-full h-fit mt-1 bg-slate-200 flex-col border border-slate-400 rounded-md">
      <textarea autofocus autoselect id="task_${boardID}_edit" maxlength="64" class="border-b border-slate-300 flex mt-[0.2px] form-control h-8 resize-none bg-transparent overflow-y-hidden pt-1 pl-2 w-full focus:text-slate-700 focus:bg-slate-50 focus:rounded-tr-md focus:rounded-tl-md focus:border focus:outline-none focus:border-slate-600">Task #${
      existingTasks + 1
    }</textarea>
      <input id="dueTo" class="flex w-full mt-0.5 mx-[0.1px] form-control px-4 bg-transparent focus:text-slate-700 border-b border-slate-300 focus:bg-slate-50 focus:border focus:outline-none focus:border-slate-600" type="date"></input>
      <div class="flex flex-row w-full h-8">
        <div title="Add priority" id="priorityButton" class="flex ml-1 my-1 h-fit w-fit px-1 py-1 hover:bg-slate-300 rounded-lg cursor-pointer" onclick="showPriorityList()">
          <svg class="flex w-4 h-4 fill-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M48 24C48 10.7 37.3 0 24 0S0 10.7 0 24V64 350.5 400v88c0 13.3 10.7 24 24 24s24-10.7 24-24V388l80.3-20.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30V66.1c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L48 52V24zm0 77.5l96.6-24.2c27-6.7 55.5-3.6 80.4 8.8c54.9 27.4 118.7 29.7 175 6.8V334.7l-24.4 9.1c-33.7 12.6-71.2 10.7-103.4-5.4c-48.2-24.1-103.3-30.1-155.6-17.1L48 338.5v-237z"/></svg>
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
  addNewTaskButton.classList.add('hidden');
  /* Focusing and select the the last input element. */
  const input = document.getElementById(`task_${boardID}_edit`);
  setTimeout(() => {
    input.select();
  }, 0);
}

function saveData(boardID) {
  let projectID = getProjectIdFromBoardId(boardID);
  let boardName = getBoardNameFromBoardId(boardID);
  const getDate = document.getElementById('dueTo').value;
  var taskName = document.getElementById(`task_${boardID}_edit`).value;
  const priority = document.getElementById('priorityListText').innerText;
  const board = document.getElementById(`${boardID}_name`);
  if (taskName == '') taskName = `Task #${board.children.length - 1}`;
  let log = new Log(projectID, null, boardID);
  $.post('../utils/scripts/task/addNewTask.php', {
    boardID,
    nameOfTask: taskName,
    date: getDate,
    priority,
  }).done((data) => {
    setTimeout(() => {
      reloadBoardData(projectID);
    }, 20);
  });
  log.logNewTask(taskName, boardName);
}

function cancelChanges(boardID) {
  /* Removing the input fields. */
  document.getElementById(`board_${boardID}_edit`).remove();
  const addNewTaskButton = document.getElementById(`${boardID}_add`);
  addNewTaskButton.classList.remove('hidden');
}

function isChecked(taskID) {
  closeAnyPopup();
  let check = document.getElementById(taskID);
  let checkmark = document.getElementById(taskID + '_check');
  let taskChecked = document.getElementById(taskID + '_taskChecked');
  classToggle(check, 'border-gray-300', 'bg-slate-50', 'border-lime-600', 'bg-lime-500');
  classToggle(checkmark, 'fill-gray-300', 'fill-white');
  classToggle(taskChecked, 'opacity-70');
  /* Updating the state of the checkbox. */
  $.post('../utils/scripts/task/updateCheckboxState.php', {
    dataID: taskID,
  });
}

$(document).keyup((e) => {
  if (e.key === 'Escape') {
    resetAllNewTasks();
    if ($('.newBoard').hasClass('h-20')) {
      expandBoardCreate();
    }
  }
});

const mouse = { x: 0, y: 0 };
document.addEventListener('mousemove', (e) => {
  mouse.x = e.clientX;
  mouse.y = e.clientY;
});

function closePriority() {
  const getOverlay = document.getElementById('popupOverlayPriority');
  if (getOverlay != null) {
    getOverlay.remove();
  }
}

function closeMoveTo() {
  const getOverlay = document.getElementById('popupPopupOverlay');
  if (getOverlay != null) {
    getOverlay.remove();
  }
}

function closeAnyPopup() {
  const getOverlay = document.getElementById('popupOverlay');
  const getSecondLOverlay = document.getElementById('popupPopupOverlay');
  if (getOverlay != null) {
    getOverlay.remove();
  }
  if (getSecondLOverlay != null) {
    getSecondLOverlay.remove();
  }
}

function closeFilter(id) {
  if ($('#popupOverlayFilter') != null) {
    saveFilter(id);
    $('#popupOverlayFilter').remove();
  }
}

function saveFilter(id) {
  const checks = [];
  const filter = document.querySelectorAll('[id*="_priFil"], [id*="_termFil"], [id*="_taskFil"]');
  filter.forEach((element) => checks.push(element.id.slice(0, element.id.indexOf('_')) + '-' + element.checked));
  if ($('#boards') != null) {
    $('#boards').empty();
    for (let i = 0; i < checks.length; i++) {
      localStorage.setItem(
        checks[i].slice(0, checks[i].indexOf('-')),
        checks[i].slice(checks[i].indexOf('-') + 1, checks[i].length)
      );
    }
    $('#boards').prepend(getBoardData(id, checks.toString()));
    if (checks.filter((el) => el.includes(true)).length > 0) {
      $('.filter-button').addClass('bg-gray-200');
      if ($('#filter-count') != null) $('#filter-count').remove();
      if ($('#filter-clear') != null) $('#filter-clear').remove();
      $('.filter-button').append(
        `<div class="flex text-sm px-1.5 bg-white rounded-lg" id="filter-count">${
          checks.filter((el) => el.includes(true)).length
        }</div>`
      );
      $('.filter-button').after(
        `<div onclick="clearFilter('${id}')" id="filter-clear" class="flex text-sm px-1.5 my-auto cursor-pointer underline transition hover:text-black/50">Clear filters</div>`
      );
    } else {
      $('.filter-button').removeClass('bg-gray-200');
      if ($('#filter-count') != null) $('#filter-count').remove();
      if ($('#filter-clear') != null) $('#filter-clear').remove();
    }
  }
}

function clearFilter(id) {
  localStorage.clear();
  if ($('#filter-count') != null) $('#filter-count').remove();
  if ($('#filter-clear') != null) $('#filter-clear').remove();
  $('.filter-button').removeClass('bg-gray-200');
  $('#boards').empty();
  $('#boards').prepend(getBoardData(id));
}

const closeModal = (e) => {
  if (e.target === e.currentTarget) closeAnyPopup();
};

const closeModalPriority = (e) => {
  if (e.target === e.currentTarget) closePriority();
};

const closeModalMoveTo = (e) => {
  if (e.target === e.currentTarget) closeMoveTo();
};

const closeFilterAndSave = (e, projectID) => {
  if (e.target === e.currentTarget) closeFilter(projectID);
};
