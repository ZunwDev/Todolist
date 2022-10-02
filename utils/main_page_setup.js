function resetStyling() {
  $("#newProj").hide();
  $("#colorSelect").hide();
  $("#profile_dropdown").hide();
}

function expandSidebar() {
  if ($("#sidebar").hasClass("shrinkSidebar")) {
    $("#sidebar").removeClass("shrinkSidebar");
    $("#sidebar").addClass("expandSidebar");
    setTimeout(() => {
      $(".app_appProjectsContainer").addClass("pl-64");
    }, 100)
    show("tabContainer");
  } else {
    $("#sidebar").removeClass("expandSidebar");
    $("#sidebar").addClass("shrinkSidebar");
    setTimeout(() => {
      $(".app_appProjectsContainer").removeClass("pl-64");
    }, 100)
    $("#tabContainer").hide();
  }
}

function toggleAngle() {
  const upClass = "toggle-up";
  const downClass = "toggle-down";

  const angle = document.querySelector(".angle");
  angle.className = angle.classList.contains("toggle-down") ? angle.classList.replace(downClass, upClass) : angle.classList.replace(upClass, downClass);
}

function show(element) {
  document.getElementById(element).style.display = "block";
}

function showFlex(element) {
  document.getElementById(element).style.display = "flex";
}

function checkDisplay(element) {
  return $(element).css('display') === 'block';
}

function checkDisplayFlex(element) {
  return $(element).css('display') === 'flex';
}

function URL(url) {
  history.pushState(
    {
      id: "TodoList",
      source: "web",
    },
    `TodoList`,
    `http://localhost/TodoList/${url}`
    );
}

function title(title) {
  document.title = title;
}