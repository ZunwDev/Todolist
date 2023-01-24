function showProfileMenu() {
	$('#profile_dropdown').css('display') == 'none' ? show('profile_dropdown') : $('#profile_dropdown').hide();
}

function userLogOut() {
	$.post('./src/auth/log_out.php', {});
	window.location = './src/auth/login.php';
}
