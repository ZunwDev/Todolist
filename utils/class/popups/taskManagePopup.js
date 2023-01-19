class TaskManagePopup extends PopupHandler {
  constructor(dataID) {
    super();
    this.dataID = dataID;
  }

  showPopup() {
    super.showPopup(getTaskManagePopup(this.dataID), super.setToCorrectPos, super.closeAnyPopup, super.closeModal);
  }
}
