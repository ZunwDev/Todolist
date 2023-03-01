let boardManager = new BoardManager();

$(document).on('click', '.acceptNewBoard', function () {
	boardManager.addBoard($(this).data('project-id'));
});

$(document).on('click', '.newBoardButton, .newBoardCancel', function () {
	boardManager.expandNewBoard();
});

$(document).on('click', '.moveTaskPopupBtn', function () {
	let moveToPopup = new MoveToPopup($(this).data('data-id'));
	moveToPopup.showPopup();
});

$(document).on('click', '.prioritySaveBtn', function () {
	boardManager.savePriority($(this).data('priority-name'));
});

$(document).on('click', '.columnManageBtn', function () {
	let columnManagePopup = new ColumnManagePopup($(this).data('board-id'));
	columnManagePopup.showPopup();
});

$(document).on('click', '.taskManageBtn', function () {
	let taskManagePopup = new TaskManagePopup($(this).data('data-id'));
	taskManagePopup.showPopup();
});

$(document).on('click', '.taskEditBtn', function () {
	let taskEditPopup = new TaskEditPopup($(this).data('data-id'));
	taskEditPopup.showPopup();
});

$(document).on('click', '.columnEditBtn', function () {
	let columnEditPopup = new ColumnEditPopup($(this).data('board-id'));
	columnEditPopup.showPopup();
});

$(document).on('click', '.projectSettings', function () {
	let projectEditPopup = new ProjectEditPopup($(this).data('project-id'));
	projectEditPopup.showPopup();
});

$(document).on('click', '.priorityMenu', function () {
	let priorityListPopup = new PriorityPopup();
	priorityListPopup.showPopup();
});

$(document).on('click', '.confirmTaskMove', function () {
	boardManager.moveTask($(this).data('board-id'), $(this).data('data-id'));
});

$(document).on('click', '.taskEditSaveBtn', function () {
	boardManager.saveEditedTask($(this).data('board-id'), $(this).data('data-id'));
});

$(document).on('click', '.projectDeleteBtn', function () {
	let projectDeleteWarning = new ProjectDeleteWarningPopup($(this).data('project-id'));
	projectDeleteWarning.showPopup();
});

$(document).on('click', '.columnClearBtn', function () {
	let columnClearWarning = new ColumnClearWarningPopup($(this).data('board-id'));
	columnClearWarning.showPopup();
});

$(document).on('click', '.columnDeleteBtn', function () {
	let columnDeleteWarning = new ColumnDeleteWarningPopup($(this).data('board-id'));
	columnDeleteWarning.showPopup();
});

$(document).on('click', '.taskDeleteBtn', function () {
	let taskDeleteWarning = new TaskDeleteWarningPopup($(this).data('data-id'));
	taskDeleteWarning.showPopup();
});

function confirmDelete(id, delReason) {
	const links = {
		projDel: 'http://localhost/TodoList/src/scripts/project/deleteProject.php',
		colCl: 'http://localhost/TodoList/src/scripts/board/clearColumn.php',
		colDel: 'http://localhost/TodoList/src/scripts/board/deleteColumn.php',
		taskDel: 'http://localhost/TodoList/src/scripts/task/deleteTask.php',
		usDel: 'http://localhost/TodoList/src/scripts/dashboard/deleteUser.php',
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
		delReason == 'usDel'
			? window.location.reload()
			: delReason != 'projDel'
			? boardManager.updateBoard(projectID)
			: window.location.reload();
	});
}

$(document).on('click', '.columnSaveBtn', function () {
	boardManager.saveEditedColumn($(this).data('board-id'));
});

$(document).on('click', '.taskAddBtn', function () {
	boardManager.addNewTaskForm($(this).data('board-id'));
});

$(document).on('click', '.saveTaskBtn', function () {
	boardManager.saveTask($(this).data('board-id'));
});

$(document).on('click', '.cancelTaskBtn', function () {
	boardManager.cancelTaskAdding($(this).data('board-id'));
});

$(document).on('click', '.setCheckmark', function () {
	boardManager.updateCheckbox($(this).data('data-id'));
});

$(document).keyup((e) => {
	if (e.key === 'Escape') {
		boardManager.resetAllNewTasks();
		if ($('.newBoard').hasClass('h-20')) {
			expandBoardCreate();
		}
	}
});

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
