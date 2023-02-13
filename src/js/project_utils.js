let projectManagerNoParam = new ProjectManager();

$(document).on('click', '.projectCreate', function () {
	projectManagerNoParam.projectCreate();
});

$(document).on('click', '.projectCreateAccept', function () {
	projectManagerNoParam.acceptProjectCreate();
});

$(document).on('click', '.openableProject', function () {
	let projectManager = new ProjectManager($(this).data('project-id'));
	projectManager.openProject();
});

$(document).on('click', '.saveProjectChanges', function () {
	let projectManager = new ProjectManager($(this).data('project-id'));
	projectManager.saveProjectEdit();
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
		projectManagerNoParam.closeProject();
		localStorage.clear();
		let popupHandler = new PopupHandler();
		popupHandler.closeAnyPopup();
	});
}
