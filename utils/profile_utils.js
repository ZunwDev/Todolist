function showProfileMenu() {
  if ($("#profile_dropdown").css('display') === 'none') {
    show("profile_dropdown");
  } else {
    $("#profile_dropdown").hide();
  }
}

function userLogOut() {
  $.post("./auth/log_out.php", {});
  window.location = "./index.php";
}
