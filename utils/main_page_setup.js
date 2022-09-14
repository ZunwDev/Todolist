function resetStyling() {
  var newProjectWindow = document.getElementById("newProj");
  newProjectWindow.style.display = "none";
  var colorSelect = document.getElementById("colorSelect");
  colorSelect.style.display = "none";
  var profileMenu = document.getElementById("profile_dropdown");
  if (profileMenu !== null) {
    profileMenu.style.display = "none";
  }
}

function expandSidebar() {
  var sidebar = document.getElementById("sidebar");
  var tabContainer = document.getElementById("tabContainer");
  if (sidebar.classList.contains("shrinkSidebar")) {
    sidebar.classList.remove("shrinkSidebar");
    sidebar.classList.add("expandSidebar");
    tabContainer.style.display = "block";
  } else {
    sidebar.classList.remove("expandSidebar");
    sidebar.classList.add("shrinkSidebar");
    tabContainer.style.display = "none";
  }
}

function toggleAngle() {
  var upClass = "toggle-up";
  var downClass = "toggle-down";

  var angle = document.querySelector(".angle");
  if (angle.classList.contains("toggle-down")) {
    angle.className = angle.classList.replace(downClass, upClass);
  } else {
    angle.className = angle.classList.replace(upClass, downClass);
  }
}
