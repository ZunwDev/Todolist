$(document).on('click', '.showProfile', function () {
	let dashBoardManager = new DashboardManager();
	dashBoardManager.showUserProfile($(this).data('user-id'));
});

$(document).on('click', '.goBackBtn', function () {
	location.reload();
});
