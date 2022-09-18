function showProfileMenu() {
  if ($("#profile_dropdown").css('display') === 'none') {
    $("#profile_dropdown").show();
  } else {
    $("#profile_dropdown").hide();
  }
}

function userLogOut() {
  $.post("./auth/log_out.php", {});
  window.location = "./index.php";
}
