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

$(document).on('click', '.filter-button', function () {
	let boardFilterPopup = new BoardFilterPopup(document.querySelector('.filter-button').getAttribute('data-project-id'));
	boardFilterPopup.showPopup();
});

$(document).on('click', '.projectLogs', function () {
	let activityTimelinePopup = new ActivityTimelinePopup(
		document.querySelector('.projectLogs').getAttribute('data-project-id')
	);
	activityTimelinePopup.showPopup();
});

if (window.history?.pushState) {
	$(window).on('popstate', () => {
		closeProject();
		localStorage.clear();
	});
}
