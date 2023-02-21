class DashboardManager {
	showUserProfile(userID) {
		document.querySelector('.overallMetrics').remove();
		$('.userList').before(getOverallMetrics(userID));
	}
}
