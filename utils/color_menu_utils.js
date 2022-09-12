function openColorSelectMenu() {
    var colorSelect = document.getElementById("colorSelect");
    var angle = document.getElementById("angleColor");
    if (colorSelect.style.display == "none") {
        angle.classList.remove("toggle-up");
        angle.classList.add("toggle-down");
        colorSelect.style.display = "block";
    } else {
        angle.classList.remove("toggle-down");
        angle.classList.add("toggle-up");
        colorSelect.style.display = "none";
    }
}

function saveColor() {
    var colorSelect = document.getElementById("colorSelect");
    var angle = document.getElementById("angleColor");
    let id = event.currentTarget.id;
    var colorCode = document.getElementById(id).firstElementChild.getAttribute("value");
    var currentColor = document.getElementById("currentColor");
    var currentColorName = document.getElementById("currentColorName");
    var lastClass = currentColor.classList.toString().split(' ').pop();
    currentColor.classList.remove(lastClass);
    currentColor.classList.add(colorCode);
    currentColorName.innerText = id;
    colorSelect.style.display = "none";
    angle.classList.remove("toggle-down");
    angle.classList.add("toggle-up");
}