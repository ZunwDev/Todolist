let projectManager = new ProjectManager();

$(document).on('click', '.projectCreate', function () {
	projectManager.projectCreate();
});

$(document).on('click', '.projectCreateAccept', function () {
	projectManager.acceptProjectCreate();
});

$(document).on('click', '.openableProject', function () {
	projectManager.openProject($(this).data('project-id'));
});

$(document).on('click', '.saveProjectChanges', function () {
	projectManager.saveProjectEdit($(this).data('project-id'));
});

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
		projectManager.closeProject();
		localStorage.clear();
		let popupHandler = new PopupHandler();
		popupHandler.closeAnyPopup();
	});
}
