function toggleClassesHeight() {
  $("#colorSelect").toggleClass("h-0");
  $("#colorSelect").toggleClass("h-32");
}

function setBeginningClass() {
  const currentColor = document.getElementById("currentColor");
  const lastClass = currentColor.classList.toString().split(" ").pop();
  const findElements = document.getElementsByClassName(lastClass);
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
    setTimeout(() => {
      $("#colorSelect").toggleClass("opacity-0");
      $("#colorSelect").hide();
    }, 50)
  }
}

function resetAllColorsAndAddNew(name) {
  const findColorElement = document.getElementById(name);
  const toRemove = document.getElementsByClassName("rounded-full");
  for (const element of toRemove) {
    element.classList.add("rounded-xl");
    element.classList.remove("rounded-full");
  }
  findColorElement.classList.add("rounded-full");
}

function saveColor(name, code) {
  const currentColor = document.getElementById("currentColor");
  const lastClass = currentColor.classList.toString().split(" ").pop();
  resetAllColorsAndAddNew(name);
  $("#currentColor").removeClass(lastClass);
  $("#currentColor").addClass(code);
  $("#currentColorName").text(name);
  openColorSelectMenu();
}