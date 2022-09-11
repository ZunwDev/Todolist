function openColorSelectMenu() {
    var colorSelect = document.getElementById("colorSelect");
    var angle = document.getElementById("angleColor");
    if (colorSelect.style.display == "none") {
        angle.classList.remove("rotateAngleNormal");
        angle.classList.add("rotateAngleDown");
        colorSelect.style.display = "block";
    } else {
        angle.classList.remove("rotateAngleDown");
        angle.classList.add("rotateAngleNormal");
        colorSelect.style.display = "none";
    }
}

function saveColor() {
    var colorSelect = document.getElementById("colorSelect");
    let id = event.target.id;
    var colorCode = document.getElementById(id).firstElementChild.getAttribute("value");
    var currentColor = document.getElementById("currentColor");
    var currentColorName = document.getElementById("currentColorName");
    var lastClass = currentColor.classList.toString().split(' ').pop();
    currentColor.classList.remove(lastClass);
    currentColor.classList.add(colorCode);
    currentColorName.innerText = id;
    colorSelect.style.display = "none";
    rotateAngle("angleColor");
}