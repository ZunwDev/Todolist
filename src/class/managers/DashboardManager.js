class DashboardManager {
	showUserProfile(userID) {
		document.querySelector('.overallMetrics').remove();
		$('.userList').before(getOverallMetrics(userID, ''));
	}

	searchUsers(data) {
		document.querySelector('.userList').remove();
		$('.overallMetrics').after(getUserList(data));
	}
}
