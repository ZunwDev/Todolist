class Color {
  constructor(color_code) {
    this.color_code = color_code;
  }

  getNum() {
    const onlyNum = this.color_code.replace(/\D/g, '');
    let num;

    if (onlyNum !== '') {
      return (num = Number(onlyNum));
    }
  }
  splitColor() {
    return this.color_code.split('-');
  }
  getLighter(mod) {
    const splitted = this.splitColor();
    return `${splitted[0]}-${splitted[1]}-${this.getNum() - mod}`;
  }
  getDarker(mod) {
    const splitted = this.splitColor();
    return `${splitted[0]}-${splitted[1]}-${this.getNum() + mod}`;
  }
}
