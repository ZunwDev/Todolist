class PopupHandler {
  popupModalSettings(listener) {
    classToggle(document.getElementById('popupElement'), 'beforeShowUp', 'afterShowUp');
    document.getElementById('popupOverlay').addEventListener('pointerdown', listener);
  }

  setToCorrectPos() {
    let diff = document.body.scrollHeight - mouse.y;
    let bheight = document.body.scrollHeight;
    let mdiff = mouse.y + document.body.scrollHeight - diff;

    mdiff > bheight
      ? document.getElementById('popupElement').classList.add(`top-[${mouse.y + window.scrollY - 128}px]`)
      : document.getElementById('popupElement').classList.add(`top-[${mouse.y + window.scrollY}px]`);
      document.getElementById('popupElement').classList.add(`left-[${mouse.x + window.scrollX + 16}px]`);
  }

  showPopup(htmlString, setPosFunction, closeAnyPopup, closeSettings) {
    closeAnyPopup();
    body.insertAdjacentHTML('beforeend', htmlString);
    setPosFunction();
    this.popupModalSettings(closeSettings);
  }

  closeAnyPopup() {
    if (document.getElementById('popupOverlay') != null) {
      document.getElementById('popupOverlay').remove();
    }
  }

  closeModal(e) {
    if (e.target === e.currentTarget) {
      closeAnyPopup();
    }
  }
}
