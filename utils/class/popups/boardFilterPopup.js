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
  }
}
