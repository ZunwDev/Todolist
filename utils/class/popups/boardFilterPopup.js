class BoardFilterPopup extends PopupHandler {
    constructor(projectID) {
        super();
        this.projectID = projectID;
    }

    closeFilterAndSave(e, projectID) {
        if (e.target === e.currentTarget) closeFilter(projectID);
    };

    showPopup() {
        super.showPopup(getBoardFilterPopup(this.projectID), super.openPopupUnderButton, super.closeAnyPopup, (e) =>
            this.closeFilterAndSave(e, this.projectID), "popupOverlayFilter"
        );
    }
}