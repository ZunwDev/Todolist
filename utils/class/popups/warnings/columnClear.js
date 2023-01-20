class ColumnClearWarningPopup extends WarningHandler {
	constructor(id) {
		super();
		this.id = id;
	}

	showPopup() {
		super.showWarning(
			getDeletePopup(
				this.id,
				'Column clear',
				'Are you sure you want to clear this column? You will lose all saved data.',
				'colCl'
			),
			super.closeAnyPopup,
			super.closeModal
		);
	}
}
