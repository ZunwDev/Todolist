function setClassToBeggining(element, classToAdd) {
	let splittedClass = $(`#${element}`).attr('class').split(' ');
	splittedClass.unshift(classToAdd);
	document.getElementById(element).classList = splittedClass.join(' ');
}

function expandSidebar() {
	if ($('#sidebar').hasClass('shrinkSidebar')) {
		show('sidebar');
		let sidebar = document.getElementById('sidebar');
		sidebar.classList.remove('shrinkSidebar');
		setClassToBeggining('sidebar', 'expandSidebar');
		setTimeout(() => {
			$('.app_appProjectsContainer').addClass('pl-64');
		}, 200);
		return;
	}
	sidebar.classList.remove('expandSidebar');
	setClassToBeggining('sidebar', 'shrinkSidebar');
	setTimeout(() => {
		$('.app_appProjectsContainer').removeClass('pl-64');
		$('#sidebar').hide();
	}, 200);
}

function toggleAngle() {
	const upClass = 'toggle-up';
	const downClass = 'toggle-down';

	const angle = document.querySelector('.angle');
	angle.className = angle.classList.contains('toggle-down')
		? angle.classList.replace(downClass, upClass)
		: angle.classList.replace(upClass, downClass);
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
