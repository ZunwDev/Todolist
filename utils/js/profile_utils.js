function showProfileMenu() {
  !checkDisplay() ? show('profile_dropdown') : $('#profile_dropdown').hide();
}

function userLogOut() {
  $.post('./auth/log_out.php', {});
  window.location = './index.php';
}
