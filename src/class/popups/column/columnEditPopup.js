class ColumnEditPopup extends PopupHandler {
    constructor(boardID) {
        super();
        this.boardID = boardID;
    }

    showPopup() {
        super.showPopup(getColumnEditPopup(this.boardID), () => {}, super.closeAnyPopup, super.closeModal);
    }
}