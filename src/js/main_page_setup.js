function setClassToBeggining(element, classToAdd) {
	let splittedClass = $(`#${element}`).attr('class').split(' ');
	splittedClass.unshift(classToAdd);
	document.getElementById(element).classList = splittedClass.join(' ');
}

function expandSidebar() {
	let sidebar = document.getElementById('sidebar');
	if ($('#sidebar').hasClass('shrinkSidebar')) {
		sidebar.classList.remove('shrinkSidebar');
		setClassToBeggining('sidebar', 'expandSidebar');
		setTimeout(() => {
			$('.app_appProjectsContainer').addClass('pl-64');
		}, 80);
		return;
	}
	sidebar.classList.remove('expandSidebar');
	setClassToBeggining('sidebar', 'shrinkSidebar');
	setTimeout(() => {
		$('.app_appProjectsContainer').removeClass('pl-64');
	}, 150);
}

function show(element) {
	document.getElementById(element).style.display = 'block';
}

function showFlex(element) {
	document.getElementById(element).style.display = 'flex';
}

function URL(url) {
	history.pushState(
		{
			id: 'TodoList',
			source: 'web',
		},
		`TodoList`,
		`http://localhost/TodoList/${url}`
	);
}

function title(title) {
	document.title = title;
}

const classToggle = (el, ...args) => {
	args.map((e) => el.classList.toggle(e));
};
