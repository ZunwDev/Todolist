function resetErrorMessage(elementValue) {
  elementValue.innerHTML = "";
}
function resetInput(element, elementError) {
  element.classList.remove("!border-pink-500");
  element.classList.remove("!text-pink-500");
  resetErrorMessage(elementError);
}
function showError(elementValue, errorMessage) {
  elementValue.innerHTML = errorMessage;
}
function flagInput(element) {
  element.classList.add("!border-pink-500");
  element.classList.add("!text-pink-500");
}
