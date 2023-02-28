let dashBoardManager = new DashboardManager();
$(document).on('click', '.showProfile', function () {
	dashBoardManager.showUserProfile($(this).data('user-id'));
});

$(document).on('click', '.goBackBtn', function () {
	location.reload();
});

$(document).on('click', '.searchBtn', function () {
	dashBoardManager.searchUsers($('.search').val());
});

$(document).keyup((e) => {
	if (e.key === 'Enter') {
		dashBoardManager.searchUsers($('.search').val());
	}
});

function hideSidebarBtn() {
	document.querySelector('#opensidebar').style.display = 'none';
}
