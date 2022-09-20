function toggleClassesHeight() {
  $("#colorSelect").toggleClass("h-0");
  $("#colorSelect").toggleClass("h-32");
}

function setBeginningClass() {
  var currentColor = document.getElementById("currentColor");
  var lastClass = currentColor.classList.toString().split(" ").pop();
  var findElements = document.getElementsByClassName(lastClass);
  findElements[findElements.length - 1].classList.remove("rounded-xl");
  findElements[findElements.length - 1].classList.add("rounded-full");
}

function openColorSelectMenu() {
  if ($("#colorSelect").css('display') === "none") {
    setBeginningClass();
    showFlex("colorSelect");
    $("#angleColor").removeClass("toggle-up");
    $("#angleColor").addClass("toggle-down");
    $("#colorSelect").toggleClass("opacity-0");
    toggleClassesHeight();
  } else {
    $("#angleColor").addClass("toggle-up");
    $("#angleColor").removeClass("toggle-down");
    toggleClassesHeight();
    setTimeout(function () {
      $("#colorSelect").toggleClass("opacity-0");
      $("#colorSelect").hide();
    }, 50)
  }
}

function resetAllColorsAndAddNew(name) {
  var findColorElement = document.getElementById(name);
  var toRemove = document.getElementsByClassName("rounded-full");
  for (var i = 0; i < toRemove.length; i++) {
    toRemove[i].classList.add("rounded-xl");
    toRemove[i].classList.remove("rounded-full");
  }
  findColorElement.classList.add("rounded-full");
}

function saveColor(name, code) {
  var currentColor = document.getElementById("currentColor");
  var lastClass = currentColor.classList.toString().split(" ").pop();
  resetAllColorsAndAddNew(name);
  $("#currentColor").removeClass(lastClass);
  $("#currentColor").addClass(code);
  $("#currentColorName").text(name);
  openColorSelectMenu();
}