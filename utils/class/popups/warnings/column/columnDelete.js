class ColumnDeleteWarningPopup extends WarningHandler {
	constructor(id) {
		super();
		this.id = id;
	}

	showPopup() {
		super.showWarning(
			getDeletePopup(
				this.id,
				'Column delete',
				'Are you sure you want to delete this column? You will lose all saved data.',
				'colDel'
			),
			super.closeAnyPopup,
			super.closeModal
		);
	}
}
