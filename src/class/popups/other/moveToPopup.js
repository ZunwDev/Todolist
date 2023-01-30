class MoveToPopup extends PopupHandler {
	constructor(taskID) {
		super();
		this.taskID = taskID;
		this.overlayId = 'popupPopupOverlay';
		this.elementId = 'popupPopupElement';
	}

	closeModalMoveTo = (e) => {
		if (e.target === e.currentTarget) {
			const getOverlay = document.getElementById('popupPopupOverlay');
			if (getOverlay != null) {
				getOverlay.remove();
			}
		}
	};

	setToCorrectPos() {
		document.getElementById('popupPopupElement').classList.add(`left-[${mouse.x + 64}px]`, `top-[${mouse.y - 128}px]`);
	}

	showPopup() {
		super.showPopup(
			getMoveToPopup(this.taskID),
			this.setToCorrectPos,
			() => {},
			(e) => this.closeModalMoveTo(e),
			this.overlayId,
			this.elementId
		);
	}
}
