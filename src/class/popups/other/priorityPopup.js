class PriorityPopup extends PopupHandler {
	constructor() {
		super();
		this.overlayId = 'popupOverlayPriority';
		this.elementId = 'popupElementPriority';
	}

	closePriority() {
		const overlay = document.querySelector(`#${this.overlayId}`);
		if (overlay != null) {
			overlay.remove();
		}
	}

	closeModalPriority(e) {
		if (e && e.target === e.currentTarget) this.closePriority();
	}

	setToCorrectPos() {
		document
			.getElementById('popupElementPriority')
			.classList.add(`left-[${mouse.x + 64}px]`, `top-[${mouse.y - 128}px]`);
	}

	showPopup() {
		super.showPopup(
			getPriorityPopup(),
			this.setToCorrectPos,
			() => {},
			(e) => this.closeModalPriority(e),
			this.overlayId,
			this.elementId
		);
	}
}
