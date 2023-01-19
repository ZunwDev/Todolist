class PriorityPopup extends PopupHandler {
    constructor() {
        super();
    }

    closeModalPriority(e) {
        if (e.target === e.currentTarget) {
            if (document.getElementById('popupOverlayPriority') != null) {
                document.getElementById('popupOverlayPriority').remove();
            }
        };
    };

    setToCorrectPos() {
        document.getElementById('popupElementPriority').classList.add(`left-[${mouse.x + 64}px]`, `top-[${mouse.y - 128}px]`);
    }

    showPopup() {
        super.showPopup(getPriorityPopup(), this.setToCorrectPos(), () => {}, (e) =>
            this.closeModalPriority(e), "popupOverlayPriority", "popupElementPriority"
        );
    }
}