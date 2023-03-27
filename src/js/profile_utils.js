$(document).on('click', '.profileMenu', function () {
	let profileMenuPopup = new ProfileMenuPopup($(this).data('admin'));
	profileMenuPopup.showPopup();
});

$(document).on('click', '.logOut', function () {
	$.post('http://xtodolist.tode.cz/src/auth/log_out.php', {});
	window.location = 'http://xtodolist.tode.cz/TodoList/src/auth/login.php';
});

$(document).on('click', '.dashboardBtn', function () {
	window.open('http://xtodolist.tode.cz/dashboard.php');
});
