class ProfileMenuPopup extends PopupHandler {
	constructor(admin) {
		super();
		this.admin = admin;
		this.overlayId = 'popupOverlay';
		this.elementId = 'popupElement';
	}

	openPopupUnderButton() {
		let el = document.getElementById('popupElement');
		el.classList.add(`left-[${mouse.x - 64}px]`);
	}

	showPopup() {
		super.showPopup(getProfileMenuPopup(this.admin), this.openPopupUnderButton, super.closeAnyPopup, super.closeModal);
	}
}
