class PopupHandler {
  popupModalSettings(listener, overlay, element = 'popupElement') {
    if (document.getElementById(element) != null) {
      classToggle(document.getElementById(element), 'beforeShowUp', 'afterShowUp');
      document.getElementById(overlay).addEventListener('pointerdown', listener);
    }
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

  showPopup(
    htmlString,
    setPosFunction,
    closeAnyPopup,
    closeSettings,
    overlay = 'popupOverlay',
    element = 'popupElement'
  ) {
    closeAnyPopup();
    body.insertAdjacentHTML('beforeend', htmlString);
    setPosFunction();
    this.popupModalSettings(closeSettings, overlay, element);
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
