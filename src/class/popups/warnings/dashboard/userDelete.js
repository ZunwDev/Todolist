class UserDeleteWarningPopup extends WarningHandler {
	constructor(id) {
		super();
		this.id = id;
	}

	showPopup() {
		super.showWarning(
			getDeletePopup(
				this.id,
				'User delete',
				'Are you sure you want to delete this user? He will be deleted completely.',
				'usDel'
			),
			super.closeAnyPopup,
			super.closeModal
		);
	}
}
