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

function showMoveToPopup(dataID) {
	let moveToPopup = new MoveToPopup(dataID);
	moveToPopup.showPopup();
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
	let boardManager = new BoardManager(boardID);
	boardManager.saveEditedColumn();
}

function addNewTask(boardID) {
	let boardManager = new BoardManager(boardID);
	boardManager.addNewTaskForm();
}

function saveData(boardID) {
	let boardManager = new BoardManager(boardID);
	boardManager.saveTask();
}

function cancelChanges(boardID) {
	let boardManager = new BoardManager(boardID);
	boardManager.cancelTaskAdding();
}

function isChecked(taskID) {
	let boardManager = new BoardManager();
	boardManager.updateCheckbox(taskID);
}

$(document).keyup((e) => {
	if (e.key === 'Escape') {
		let boardManager = new BoardManager();
		boardManager.resetAllNewTasks();
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
