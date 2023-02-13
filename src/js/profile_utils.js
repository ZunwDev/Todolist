$(document).on('click', '.profileMenu', function () {
	let profileMenuPopup = new ProfileMenuPopup($(this).data('admin'));
	profileMenuPopup.showPopup();
});

$(document).on('click', '.logOut', function () {
	$.post('./src/auth/log_out.php', {});
	window.location = './src/auth/login.php';
});
