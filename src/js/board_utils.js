function addBoard(id) {
	let boardManager = new BoardManager();
	boardManager.addBoard(id);
}

function expandBoardCreate() {
	let boardManager = new BoardManager();
	boardManager.expandNewBoard();
}

function updateBoard(id) {
	let boardManager = new BoardManager();
	boardManager.updateBoard(id);
}

function resetAllNewTasks() {
	let boardManager = new BoardManager();
	boardManager.resetAllNewTasks();
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
	let boardManager = new BoardManager();
	boardManager.savePriority(name);
}

function showTaskManagePopup(dataID) {
	let taskManagePopup = new TaskManagePopup(dataID);
	taskManagePopup.showPopup();
}

function showColumnManagePopup(boardID) {
	let columnManagePopup = new ColumnManagePopup(boardID);
	columnManagePopup.showPopup();
}

function showTaskEditPopup(dataID) {
	let taskEditPopup = new TaskEditPopup(dataID);
	taskEditPopup.showPopup();
}

function showColumnEdit(boardID) {
	let columnEditPopup = new ColumnEditPopup(boardID);
	columnEditPopup.showPopup();
}

function showProjectEdit(id) {
	let projectEditPopup = new ProjectEditPopup(id);
	projectEditPopup.showPopup();
}

function showPriorityPopup() {
	let priorityListPopup = new PriorityPopup();
	priorityListPopup.showPopup();
}

function showBoardFilterPopup(projectID) {
	let boardFilterPopup = new BoardFilterPopup(projectID);
	boardFilterPopup.showPopup();
}

function confirmMoving(boardID, dataID) {
	let boardManager = new BoardManager(boardID);
	boardManager.moveTask(dataID);
}

function saveTaskEdit(dataID, boardID) {
	let boardManager = new BoardManager(boardID);
	boardManager.saveEditedTask(dataID);
}

function showProjectDeleteWarning(id) {
	let projectDeleteWarning = new ProjectDeleteWarningPopup(id);
	projectDeleteWarning.showPopup();
}

function showColumnClearWarning(id) {
	let columnClearWarning = new ColumnClearWarningPopup(id);
	columnClearWarning.showPopup();
}

function showTaskDeleteWarning(id) {
	let taskDeleteWarning = new TaskDeleteWarningPopup(id);
	taskDeleteWarning.showPopup();
}

function showColumnDeleteWarning(id) {
	let columnDeleteWarning = new ColumnDeleteWarningPopup(id);
	columnDeleteWarning.showPopup();
}

function confirmDelete(id, delReason) {
	const links = {
		projDel: '../src/scripts/project/deleteProject.php',
		colCl: '../src/scripts/board/clearColumn.php',
		colDel: '../src/scripts/board/deleteColumn.php',
		taskDel: '../src/scripts/task/deleteTask.php',
	};

	let projectID = delReason == 'taskDel' ? getProjectIdFromTaskId(id) : getProjectIdFromBoardId(id);
	if (delReason == 'taskDel') {
		let log = new LogManager(projectID, id, getBoardIdFromTaskId(id));
		log.logRemoveTask(getTaskNameFromTaskId(id), getBoardNameFromTaskId(id));
	}
	if (delReason == 'colCl') {
		let log = new LogManager(projectID, null, id);
		log.logClearColumn(getBoardNameFromBoardId(id));
	}
	if (delReason == 'colDel') {
		let log = new LogManager(projectID, null, id);
		log.logRemoveColumn(getBoardNameFromBoardId(id));
	}
	$.post(links[delReason], {
		id,
	}).done((data) => {
		delReason != 'projDel' ? updateBoard(projectID) : window.location.reload();
	});
}

function saveColumnChanges(boardID) {
	let projectID = getProjectIdFromBoardId(boardID);
	let newBoardName = document.getElementById('columnNameEdit').value;
	const newBoardDescription = document.getElementById('columnDescriptionEdit').value;
	if (newBoardName == '' || newBoardName == null) newBoardName = 'Untitled Column';
	let log = new LogManager(projectID, null, boardID);
	$.post('../src/scripts/board/saveColumnEdit.php', {
		boardID,
		board_name: newBoardName,
		board_description: newBoardDescription,
	}).done((data) => updateBoard(projectID));
	log.logColumnUpdate(getBoardNameFromBoardId(boardID), newBoardName);
}

function addNewTask(boardID) {
	resetAllNewTasks();
	const board = document.getElementById(`${boardID}_name`);
	const existingTasks = board.children.length;
	board.insertAdjacentHTML(
		'beforeend',
		`
    <div id="board_${boardID}_edit" class="flex flex-col edit gap-2">
    <div class="w-full h-fit mt-1 bg-slate-200 flex-col border border-slate-400 rounded-md">
      <textarea autofocus autoselect id="task_${boardID}_edit" maxlength="64" class="border-b border-slate-300 flex mt-[0.2px] form-control h-8 resize-none bg-transparent overflow-y-hidden pt-1 pl-2 w-full focus:text-slate-700 focus:bg-slate-50 focus:rounded-tr-md focus:rounded-tl-md focus:border focus:outline-none focus:border-slate-600">Task #${existingTasks}</textarea>
      <input id="dueTo" class="flex w-full mt-0.5 mx-[0.1px] form-control px-4 bg-transparent focus:text-slate-700 border-b border-slate-300 focus:bg-slate-50 focus:border focus:outline-none focus:border-slate-600" type="date"></input>
      <div class="flex flex-row w-full h-8">
        <div title="Add priority" id="priorityButton" class="flex ml-1 my-1 h-fit w-fit px-1 py-1 hover:bg-slate-300 rounded-lg cursor-pointer" onclick="showPriorityPopup()">
          <svg class="flex w-4 h-4 fill-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M48 24C48 10.7 37.3 0 24 0S0 10.7 0 24V64 350.5 400v88c0 13.3 10.7 24 24 24s24-10.7 24-24V388l80.3-20.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30V66.1c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L48 52V24zm0 77.5l96.6-24.2c27-6.7 55.5-3.6 80.4 8.8c54.9 27.4 118.7 29.7 175 6.8V334.7l-24.4 9.1c-33.7 12.6-71.2 10.7-103.4-5.4c-48.2-24.1-103.3-30.1-155.6-17.1L48 338.5v-237z"/></svg>
        </div>
        <div id="priorityList" class="flex w-fit ml-4 h-fit my-1 rounded-lg border border-transparent bg-transparent" onclick="showPriorityPopup()">
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
	const input = document.getElementById(`task_${boardID}_edit`);
	setTimeout(() => {
		input.select();
	}, 0);
}

function saveData(boardID) {
	var taskName = document.getElementById(`task_${boardID}_edit`).value;
	const board = document.getElementById(`${boardID}_name`);
	if (taskName == '') taskName = `Task #${board.children.length - 1}`;
	let log = new LogManager(getProjectIdFromBoardId(boardID), null, boardID);
	$.post('../src/scripts/task/addNewTask.php', {
		boardID,
		nameOfTask: taskName,
		date: $('#dueTo').val(),
		priority: $('#priorityListText').text(),
	}).done((data) => {
		setTimeout(() => {
			updateBoard(getProjectIdFromBoardId(boardID));
		}, 20);
	});
	log.logNewTask(taskName, getBoardNameFromBoardId(boardID));
}

function cancelChanges(boardID) {
	document.getElementById(`board_${boardID}_edit`).remove();
	const addNewTaskButton = document.getElementById(`${boardID}_add`);
	addNewTaskButton.classList.remove('hidden');
}

function isChecked(taskID) {
	closeAnyPopup();
	classToggle(document.getElementById(taskID), 'border-gray-300', 'bg-slate-50', 'border-lime-600', 'bg-lime-500');
	classToggle(document.getElementById(taskID + '_check'), 'fill-gray-300', 'fill-white');
	classToggle(document.getElementById(taskID + '_taskChecked'), 'opacity-70');
	$.post('../src/scripts/task/updateCheckboxState.php', {
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

const mouse = {
	x: 0,
	y: 0,
};
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

const closeModalMoveTo = (e) => {
	if (e.target === e.currentTarget) closeMoveTo();
};
