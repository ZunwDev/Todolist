$(document).on('click', '.profileMenu', function () {
  let profileMenuPopup = new ProfileMenuPopup($(this).data('admin'));
  profileMenuPopup.showPopup();
});

$(document).on('click', '.logOut', function () {
  $.post('http://localhost/TodoList/src/auth/log_out.php', {});
  window.location = 'http://localhost/TodoList/src/auth/login.php';
});
