
  function resetStyling() {
    $("#newProj").hide();
    $("#colorSelect").hide();
    $("#profile_dropdown").hide();
  }
  
  function expandSidebar() { 
    if ($("#sidebar").hasClass("shrinkSidebar")) {
      $("#sidebar").removeClass("shrinkSidebar");
      $("#sidebar").addClass("expandSidebar");
      $("#tabContainer").show();
    } else {
      $("#sidebar").removeClass("expandSidebar");
      $("#sidebar").addClass("shrinkSidebar");
      $("#tabContainer").hide();
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

