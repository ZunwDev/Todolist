function resetErrorMessage(elementValue) {
  elementValue.innerText = '';
}
function resetInput(element, elementError) {
  element.classList.remove('!border-pink-500');
  element.classList.remove('!text-pink-500');
  resetErrorMessage(elementError);
}
function showError(elementValue, errorMessage) {
  elementValue.innerText = errorMessage;
}
function flagInput(element) {
  element.classList.add('!border-pink-500');
  element.classList.add('!text-pink-500');
}

function passwordVerifyFailed() {
  const passwordEl = document.getElementById('passwordInput');
  const passwordError = document.getElementById('passwordError');

  flagInput(passwordEl);
  showError(passwordError, 'Incorrect password');
}

function userDoesntExist() {
  const usernameEl = document.getElementById('nameInput');
  const usernameError = document.getElementById('usernameError');

  flagInput(usernameEl);
  showError(usernameError, "User doesn't exist/invalid username");
}

function successfulLogin() {
  resetInput(document.getElementById('nameInput'), document.getElementById('usernameError'));
  resetInput(document.getElementById('passwordInput'), document.getElementById('passwordError'));
  setTimeout(() => {
    window.location = '../index.php';
  }, 1000);
}

function logIn() {
  const username = $('#nameInput').val();
  const password = $('#passwordInput').val();

  $.post('./login_script.php', {
    nameInput: username,
    passwordInput: password,
  }).done((data) => {
    if (data.includes('200')) successfulLogin();
    if (data.includes('403'))
      resetInput(document.getElementById('nameInput'), document.getElementById('usernameError'));
    if (data.includes('403')) return passwordVerifyFailed();
    if (data.includes('404')) return userDoesntExist();
  });
}
