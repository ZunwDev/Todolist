function setBeginningClass() {
  const currentColor = document.getElementById('currentColor');
  const lastClass = currentColor.classList.toString().split(' ').pop();
  const findElements = document.getElementsByClassName(lastClass);
  findElements[findElements.length - 1].classList.remove('rounded-xl');
  findElements[findElements.length - 1].classList.add('rounded-full');
}

function openColorSelectMenu() {
  let angleColor = document.getElementById('angleColor');
  let colorSelect = document.getElementById('colorSelect');
  if (document.getElementById('colorSelect').style.display === 'none') {
    setBeginningClass();
    showFlex('colorSelect');
    classToggle(angleColor, 'toggle-up', 'toggle-down');
    classToggle(colorSelect, 'h-0', 'h-32', 'opacity-0');
  } else {
    classToggle(angleColor, 'toggle-up', 'toggle-down');
    classToggle(colorSelect, 'h-0', 'h-32');
    setTimeout(() => {
      classToggle(colorSelect, 'opacity-0');
      $('#colorSelect').hide();
    }, 50);
  }
}

function resetAllColorsAndAddNew(name) {
  const toRemove = document.getElementsByClassName('rounded-full');
  for (const element of toRemove) {
    if (element.id != '') {
      element.classList.remove('rounded-full');
      element.classList.add('rounded-xl');
    }
  }
  $('#' + name).addClass('rounded-full');
}

function saveColor(name, code) {
  const currentColor = document.getElementById('currentColor');
  const lastClass = currentColor.classList.toString().split(' ').pop();
  resetAllColorsAndAddNew(name);
  $('#currentColor').removeClass(lastClass);
  $('#currentColor').addClass(code);
  $('#currentColorName').text(name);
  openColorSelectMenu();
}
