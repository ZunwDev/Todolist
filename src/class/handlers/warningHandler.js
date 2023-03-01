class WarningHandler extends PopupHandler {
	constructor(id) {
		super();
	}

	closeAnyPopup() {
		if (document.getElementById('popupOverlay') != null) {
			document.getElementById('popupOverlay').remove();
		}
	}

	closeModal(e) {
		if (e.target === e.currentTarget) {
			closeAnyPopup();
		}
	}

	showWarning(htmlString, closeAnyPopup, closeSettings) {
		closeAnyPopup();
		body.insertAdjacentHTML('beforeend', htmlString);
		super.popupModalSettings(closeSettings, 'popupOverlay', 'popupElement');
	}

	popupModalSettings(listener, overlay, element = 'popupElement') {
		if (document.getElementById(element) != null) {
			classToggle(document.getElementById(element), 'beforeShowUp', 'afterShowUp');
			document.getElementById(overlay).addEventListener('pointerdown', listener);
		}
	}
}
