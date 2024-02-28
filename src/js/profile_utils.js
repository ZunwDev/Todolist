$(document).on("click", ".profileMenu", function () {
  let profileMenuPopup = new ProfileMenuPopup($(this).data("admin"));
  profileMenuPopup.showPopup();
});

$(document).on("click", ".logOut", function () {
  $.post("https://xtodolist.tode.cz/src/auth/log_out.php", {});
  window.location = "https://xtodolist.tode.cz/src/auth/login.php";
});

$(document).on("click", ".dashboardBtn", function () {
  window.open("https://xtodolist.tode.cz/dashboard.php");
});
