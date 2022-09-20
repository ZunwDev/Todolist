class Color {
    constructor (color_code) {
        this.color_code = color_code;
    }

    getNum() {
        const onlyNum = this.color_code.replace(/\D/g, '');
        let num;
      
        if (onlyNum !== '') {
          return num = Number(onlyNum);
        }
    }   
    splitColor() {
        return this.color_code.split("-");
    }
    getLighter() {
        var splitted = this.splitColor();
        return "bg-" + splitted[1] + "-" + (this.getNum() - 100);
    }
    getDarker() {
        var splitted = this.splitColor();
        return "bg-" + splitted[1] + "-" + (this.getNum() + 100);
    }
}