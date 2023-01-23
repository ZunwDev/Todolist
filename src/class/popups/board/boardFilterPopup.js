class BoardFilterPopup extends PopupHandler {
	constructor(projectID) {
		super();
		this.projectID = projectID;
	}

	closeFilterAndSave(e, projectID) {
		if (e.target === e.currentTarget) closeFilter(projectID);
	}

	openPopupUnderButton() {
		let el = document.getElementById('popupElement');
		el.classList.add(`top-[${mouse.y + 32}px]`);
		el.classList.add(`left-[${mouse.x - 64}px]`);
	}

	showPopup() {
		super.showPopup(
			getBoardFilterPopup(this.projectID),
			this.openPopupUnderButton,
			super.closeAnyPopup,
			(e) => this.closeFilterAndSave(e, this.projectID),
			'popupOverlayFilter'
		);
		let checkmarks = document.querySelectorAll('[id*="_priFil"], [id*="_termFil"], [id*="_taskFil"]');
		let ids = Array.from(checkmarks).map((element) => element.id);
		for (let i = 0; i < localStorage.length; i++) {
			let curItem = localStorage.getItem(ids[i].slice(0, ids[i].indexOf('_')));
			curItem == 'true' ? (checkmarks[i].checked = curItem) : (checkmarks[i].checked = '');
		}
	}
}
