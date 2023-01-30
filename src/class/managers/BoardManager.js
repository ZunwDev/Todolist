class BoardManager {
	constructor(boardID = null) {
		this.boardID = boardID;
	}
	updateBoard(id) {
		let popupHandler = new PopupHandler();
		popupHandler.closeAnyPopup();
		$('#boards').text('');
		$('#boards').prepend(getBoardData(id));
	}

	addBoard(projectID) {
		const newProjectName = $('#newBoardInput').val();
		let finalProjectName = newProjectName.length > 0 ? newProjectName : 'Column';
		let log = new LogManager(projectID, null, this.boardID);
		log.logNewColumn(finalProjectName);
		$.post('../src/scripts/board/addNewBoard.php', {
			projectID: projectID,
			board_name: finalProjectName,
		}).done((data) => this.updateBoard(projectID));
	}

	expandNewBoard() {
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

	resetAllNewTasks() {
		const existingTasks = document.querySelectorAll(`div.edit`);
		const addNewTaskButton = document.querySelectorAll(`[id*='_add']`);

		for (var i = 0; i < addNewTaskButton.length; i++) {
			addNewTaskButton[i].classList.remove('hidden');
		}

		for (var i = 0; i < existingTasks.length; i++) {
			existingTasks[i].remove();
		}
	}

	savePriority(name) {
		let popupHandler = new PopupHandler();
		popupHandler.closePriority;
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

	moveTask(dataID) {
		let projectID = getProjectIdFromBoardId(this.boardID);
		let popupHandler = new PopupHandler();
		popupHandler.closeAnyPopup();
		let log = new LogManager(projectID, dataID, this.boardID);
		log.logTaskMove(
			getBoardNameFromTaskId(dataID),
			getBoardNameFromBoardId(this.boardID),
			getTaskNameFromTaskId(dataID)
		);
		$.post('../src/scripts/task/moveToAnotherBoard.php', {
			boardID: this.boardID,
			dataID: dataID,
		}).done((data) => {
			this.updateBoard(projectID);
		});
	}

	saveEditedTask(dataID) {
		let projectID = getProjectIdFromBoardId(this.boardID);
		let newTaskName = $('#taskNameEdit').val();
		let newTaskDescription = $('#taskDescriptionEdit').val();
		let newDueTo = $('#taskDueToEdit').val();
		let newPriority = $('#priorityListText').text();
		const board = document.getElementById(`${this.boardID}_name`);
		if (newTaskName == '') {
			let getTaskAmount = board.children.length;
			newTaskName = `Task ${getTaskAmount}`;
		}
		let finalTaskDescription = newTaskDescription == '' ? '' : newTaskDescription;
		let finalDueTo = newDueTo == '' ? '0000-00-00' : newDueTo;
		let finalPriority = newPriority == '' ? 'None' : newPriority;

		let log = new LogManager(projectID, dataID, this.boardID);
		$.post('../src/scripts/task/saveTaskEdit.php', {
			dataID,
			task_name: newTaskName,
			task_description: finalTaskDescription,
			task_dueTo: finalDueTo,
			task_priority: finalPriority,
		}).done((data) => {
			this.updateBoard(projectID);
		});
		log.logTaskUpdate(getTaskNameFromTaskId(dataID), getBoardNameFromBoardId(this.boardID), newTaskName);
	}

	updateCheckbox(dataID) {
		let popupHandler = new PopupHandler();
		popupHandler.closeAnyPopup();
		classToggle(document.getElementById(dataID), 'border-gray-300', 'bg-slate-50', 'border-lime-600', 'bg-lime-500');
		classToggle(document.getElementById(dataID + '_check'), 'fill-gray-300', 'fill-white');
		classToggle(document.getElementById(dataID + '_taskChecked'), 'opacity-70');
		$.post('../src/scripts/task/updateCheckboxState.php', {
			dataID: dataID,
		});
	}

	saveTask() {
		var taskName = document.getElementById(`task_${this.boardID}_edit`).value;
		const board = document.getElementById(`${this.boardID}_name`);
		if (taskName == '') taskName = `Task #${board.children.length - 1}`;
		let log = new LogManager(getProjectIdFromBoardId(this.boardID), null, this.boardID);
		$.post('../src/scripts/task/addNewTask.php', {
			boardID: this.boardID,
			nameOfTask: taskName,
			date: $('#dueTo').val(),
			priority: $('#priorityListText').text(),
		}).done((data) => {
			setTimeout(() => {
				updateBoard(getProjectIdFromBoardId(this.boardID));
			}, 20);
		});
		log.logNewTask(taskName, getBoardNameFromBoardId(this.boardID));
	}

	saveEditedColumn() {
		let projectID = getProjectIdFromBoardId(this.boardID);
		let newBoardName = document.getElementById('columnNameEdit').value;
		const newBoardDescription = document.getElementById('columnDescriptionEdit').value;
		if (newBoardName == '' || newBoardName == null) newBoardName = 'Untitled Column';
		let log = new LogManager(projectID, null, this.boardID);
		$.post('../src/scripts/board/saveColumnEdit.php', {
			boardID: this.boardID,
			board_name: newBoardName,
			board_description: newBoardDescription,
		}).done((data) => updateBoard(projectID));
		log.logColumnUpdate(getBoardNameFromBoardId(this.boardID), newBoardName);
	}

	cancelTaskAdding() {
		document.getElementById(`board_${this.boardID}_edit`).remove();
		const addNewTaskButton = document.getElementById(`${this.boardID}_add`);
		addNewTaskButton.classList.remove('hidden');
	}

	addNewTaskForm() {
		this.resetAllNewTasks();
		const board = document.getElementById(`${this.boardID}_name`);
		board.insertAdjacentHTML('beforeend', getAddNewTask(this.boardID, board.children.length));
		const addNewTaskButton = document.getElementById(`${this.boardID}_add`);
		addNewTaskButton.classList.add('hidden');
		const input = document.getElementById(`task_${this.boardID}_edit`);
		setTimeout(() => {
			input.select();
		}, 0);
	}
}
