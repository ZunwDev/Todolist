class TaskDeleteWarningPopup extends WarningHandler {
	constructor(id) {
		super();
		this.id = id;
	}

	showPopup() {
		super.showWarning(
			getDeletePopup(this.id, 'Task delete', 'Are you sure you want to delete this task?', 'taskDel'),
			super.closeAnyPopup,
			super.closeModal
		);
	}
}
