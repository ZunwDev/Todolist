class ProjectDeleteWarningPopup extends WarningHandler {
	constructor(id) {
		super();
		this.id = id;
	}

	showPopup() {
		super.showWarning(
			getDeletePopup(
				this.id,
				'Project delete',
				'Are you sure you want to delete this project? You will lose all data.',
				'projDel'
			),
			super.closeAnyPopup,
			super.closeModal
		);
	}
}
