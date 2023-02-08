function setBeginningClass() {
	const currentColor = document.getElementById('currentColor');
	const lastClass = currentColor.classList.toString().split(' ').pop();
	const findElements = document.getElementsByClassName(lastClass);
	findElements[findElements.length - 1].classList.remove('rounded-xl');
	findElements[findElements.length - 1].classList.add('rounded-full');
}

$(document).on('click', '.colorSelectMenu', function () {
	let angleColor = document.getElementById('angleColor');
	let colorSelect = document.getElementById('colorSelect');
	if (colorSelect.style.display === 'none') {
		setBeginningClass();
		showFlex('colorSelect');
		classToggle(angleColor, 'toggle-up', 'toggle-down');
		classToggle(colorSelect, 'h-0', 'h-32', 'opacity-0');
	} else {
		classToggle(angleColor, 'toggle-up', 'toggle-down');
		classToggle(colorSelect, 'h-0', 'h-32');
		setTimeout(() => {
			classToggle(colorSelect, 'opacity-0');
			colorSelect.style.display = 'none';
		}, 50);
	}
});

$(document).on('click', '.saveColor', function () {
	const currentColor = document.getElementById('currentColor');
	resetAllColorsAndAddNew($(this).data('color-name'));
	$('#currentColor').removeClass(currentColor.classList.toString().split(' ').pop());
	$('#currentColor').addClass($(this).data('color-code'));
	$('#currentColorName').text($(this).data('color-name'));
	setTimeout(() => {
		document.querySelector('#colorSelect').style.display = 'none';
	}, 50);
});

function resetAllColorsAndAddNew(name) {
	const toRemove = document.getElementsByClassName('rounded-full');
	for (const element of toRemove) {
		if (element.id != '') {
			element.classList.remove('rounded-full');
			element.classList.add('rounded-xl');
		}
	}
	$('#' + name).addClass('rounded-full');
}
