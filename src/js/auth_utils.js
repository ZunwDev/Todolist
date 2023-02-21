function resetErrorMessage(elementValue) {
	elementValue.innerText = '';
}

function resetInput(element, elementError) {
	element.classList.remove('!border-pink-500', '!text-pink-500');
	resetErrorMessage(elementError);
}

function showError(elementValue, errorMessage) {
	elementValue.innerText = errorMessage;
}

function flagInput(element) {
	element.classList.add('!border-pink-500', '!text-pink-500');
}
