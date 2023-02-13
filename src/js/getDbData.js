function getColorCode(id) {
	let data = $.ajax('./src/scripts/db/getColor.php', {
		async: false,
		type: 'POST',
		data: {
			projectID: id,
		},
	});
	return data.responseText;
}

function getProjectName(id) {
	let data = $.ajax('./src/scripts/db/getProjectName.php', {
		async: false,
		type: 'POST',
		data: {
			projectID: id,
		},
	});
	return data.responseText;
}

function getProjectIdFromBoardId(id) {
	let data = $.ajax('../src/scripts/db/getProjectIdFromBoardId.php', {
		async: false,
		type: 'POST',
		data: {
			boardID: id,
		},
	});
	return data.responseText;
}

function getBoardNameFromBoardId(id) {
	let data = $.ajax('../src/scripts/db/getBoardNameFromBoardId.php', {
		async: false,
		type: 'POST',
		data: {
			boardID: id,
		},
	});
	return data.responseText;
}

function getTaskNameFromTaskId(id) {
	let data = $.ajax('../src/scripts/db/getTaskNameFromTaskId.php', {
		async: false,
		type: 'POST',
		data: {
			taskID: id,
		},
	});
	return data.responseText;
}

function getBoardIdFromTaskId(id) {
	let data = $.ajax('../src/scripts/db/getBoardIdFromTaskId.php', {
		async: false,
		type: 'POST',
		data: {
			taskID: id,
		},
	});
	return data.responseText;
}

function getBoardNameFromTaskId(id) {
	let data = $.ajax('../src/scripts/db/getBoardNameFromTaskId.php', {
		async: false,
		type: 'POST',
		data: {
			taskID: id,
		},
	});
	return data.responseText;
}

function getProjectIdFromTaskId(id) {
	let data = $.ajax('../src/scripts/db/getProjectIdFromTaskId.php', {
		async: false,
		type: 'POST',
		data: {
			taskID: id,
		},
	});
	return data.responseText;
}

function getBoardData(id, filter = '') {
	let data = $.ajax('../src/load/board/loadBoards.php', {
		async: false,
		type: 'post',
		data: {
			projectID: id,
			filter: filter,
		},
	});
	return data.responseText;
}

function getProjectEditPopup(id) {
	let data = $.ajax('../src/load/project/loadProjectEdit.php', {
		async: false,
		type: 'POST',
		data: {
			projectID: id,
		},
	});
	return data.responseText;
}

function getProfileMenuPopup(isAdmin) {
	let data = $.ajax('./src/load/other/loadProfileMenu.php', {
		async: false,
		type: 'POST',
		data: {
			adminState: isAdmin,
		},
	});

	return data.responseText;
}

function getAddNewTask(id, taskCount) {
	let data = $.ajax('../src/load/task/loadNewTask.php', {
		async: false,
		type: 'POST',
		data: {
			boardID: id,
			taskCount: taskCount,
		},
	});
	return data.responseText;
}

function getColumnEditPopup(id) {
	let data = $.ajax('../src/load/board/loadColumnEdit.php', {
		async: false,
		type: 'post',
		data: {
			boardID: id,
		},
	});
	return data.responseText;
}

function getTaskEditPopup(id) {
	const data = $.ajax('../src/load/task/loadTaskEditPopup.php', {
		async: false,
		type: 'post',
		data: {
			dataID: id,
		},
	});
	return data.responseText;
}

function getPriorityPopup() {
	const data = $.ajax('../src/load/other/loadPriorityList.php', {
		async: false,
		type: 'post',
	});
	return data.responseText;
}

function getTaskManagePopup(id) {
	const data = $.ajax('../src/load/task/loadTaskManage.php', {
		async: false,
		type: 'post',
		data: {
			dataID: id,
		},
	});
	return data.responseText;
}

function getColumnManagePopup(id) {
	const data = $.ajax('../src/load/board/loadColumnManage.php', {
		async: false,
		type: 'post',
		data: {
			boardID: id,
		},
	});
	return data.responseText;
}

function getBoardFilterPopup(id) {
	const data = $.ajax('../src/load/board/loadBoardFilter.php', {
		async: false,
		type: 'post',
		data: {
			projectID: id,
		},
	});
	return data.responseText;
}

function getActivityTimelinePopup(id) {
	const data = $.ajax('../src/load/project/loadActivityTimeline.php', {
		async: false,
		type: 'post',
		data: {
			projectID: id,
		},
	});
	return data.responseText;
}

function getProjectCreatePopup() {
	const data = $.ajax('./src/load/project/loadProjectCreate.php', {
		async: false,
		type: 'post',
	});
	return data.responseText;
}

function getDeletePopup(id, title, msg, reason) {
	const data = $.ajax('../src/load/other/loadDeletePopup.php', {
		async: false,
		type: 'post',
		data: {
			id,
			title,
			msg,
			reason,
		},
	});
	return data.responseText;
}

function getMoveToPopup(id) {
	const projID = getProjectIdFromTaskId(id);
	const data = $.ajax('../src/load/task/loadMoveToPopup.php', {
		async: false,
		type: 'post',
		data: {
			projectID: projID,
			dataID: id,
		},
	});
	return data.responseText;
}

function getColorSelect() {
	let data = $.ajax('./src/load/other/loadColors.php', {
		async: false,
		type: 'post',
	});
	return data.responseText;
}

function getPrepHTML(id, name) {
	let data = $.ajax('./src/load/project/loadPrepHTML.php', {
		async: false,
		type: 'post',
		data: {
			projectID: id,
			name: name,
		},
	});
	return data.responseText;
}
