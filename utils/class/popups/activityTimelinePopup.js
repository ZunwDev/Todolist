class ActivityTimelinePopup extends PopupHandler {
  constructor(projectID) {
    super();
    this.projectID = projectID;
  }

  showPopup() {
    super.showPopup(getActivityTimelinePopup(this.projectID), () => {}, super.closeAnyPopup, super.closeModal);
  }
}
