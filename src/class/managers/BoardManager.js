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
		$.post('../src/scripts/board/addNewBoard.php', {
			projectID: projectID,
			board_name: finalProjectName,
		}).done((data) => this.updateBoard(this.boardID));
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

	moveTask(dataID) {
		let projectID = getProjectIdFromBoardId(this.boardID);
		let popupHandler = new PopupHandler();
		popupHandler.closeAnyPopup();
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
}
