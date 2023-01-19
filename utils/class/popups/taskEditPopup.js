class TaskEditPopup extends PopupHandler {
    constructor(dataID) {
        super();
        this.dataID = dataID;
    }

    showPopup() {
        super.showPopup(getTaskEditPopup(this.dataID), () => {}, super.closeAnyPopup, super.closeModal);
    }
}