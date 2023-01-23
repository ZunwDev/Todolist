class ColumnManagePopup extends PopupHandler {
    constructor(boardID) {
        super();
        this.boardID = boardID;
    }

    showPopup() {
        super.showPopup(getColumnManagePopup(this.boardID), super.setToCorrectPos, super.closeAnyPopup, super.closeModal);
    }
}