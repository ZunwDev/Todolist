class ProjectCreatePopup extends PopupHandler {
  constructor() {
    super();
  }

  showPopup() {
    super.showPopup(getProjectCreatePopup(), () => {}, super.closeAnyPopup, super.closeModal);
  }
}
