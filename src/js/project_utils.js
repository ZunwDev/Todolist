let projectManagerNoParam = new ProjectManager();

function openProjectCreate() {
  projectManagerNoParam.projectCreate();
}

function acceptProjectCreate() {
  projectManagerNoParam.acceptProjectCreate();
}

function closeProject() {
  projectManagerNoParam.closeProject();
}

function openProject(id) {
  let projectManager = new ProjectManager(id);
  projectManager.openProject();
}

function saveProjectChanges(id) {
  let projectManager = new ProjectManager(id);
  projectManager.saveProjectEdit();
}

document.addEventListener('DOMContentLoaded', function () {
  document.querySelector('.app_appProjectsContainer').addEventListener('pointerdown', (event) => {
    const filterButton = event.target.closest('.filter-button');
    if (filterButton) {
      event.stopPropagation();
      showBoardFilterPopup(filterButton.getAttribute('data-board-id'), event);
    }
  });
});

function showActivityTimeline(projectID) {
  let activityTimelinePopup = new ActivityTimelinePopup(projectID);
  activityTimelinePopup.showPopup();
}

if (window.history?.pushState) {
  $(window).on('popstate', () => {
    closeProject();
    localStorage.clear();
  });
}
