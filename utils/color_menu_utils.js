function toggleClassesHeight() {
  $("#colorSelect").toggleClass("h-0");
  $("#colorSelect").toggleClass("h-96");
}

function openColorSelectMenu() {
  if ($("#colorSelect").css('display') === "none") {
    $("#colorSelect").show();
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

function saveColor() {
  let id = event.currentTarget.id;
  var colorCode = document.getElementById(id).firstChild.getAttribute("value");
  var currentColor = document.getElementById("currentColor");
  var lastClass = currentColor.classList.toString().split(" ").pop();
  $("#currentColor").removeClass(lastClass);
  $("#currentColor").addClass(colorCode);
  $("#currentColorName").text(id);
  $("#colorSelect").hide();
  $("#angleColor").removeClass("toggle-down");
  $("#angleColor").addClass("toggle-up");
}
