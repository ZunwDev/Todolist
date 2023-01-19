class ProjectEditPopup extends PopupHandler {
    constructor(projectID) {
        super();
        this.projectID = projectID;
    }

    showPopup() {
        super.showPopup(getProjectEditPopup(this.projectID), () => {}, super.closeAnyPopup, super.closeModal);
    }
}