export default class SliderDemo {
  constructor() {
    this.$this = $('.mod-slider')
  }

  init() {
    if (this.$this.length) {
      this.addSlick()
    }
  }

  addSlick() {
    this.$this.find('.slider').slick({
      rows: 0,
      adaptiveHeight: true,
      arrows: true,
      dots: true,
      prevArrow:
        '<button class="slick-prev arrows h1 text-primary-300"><span class="icomoon icon-chevron-left"></span><span class="sr-only">Prev slider</span></button>',
      nextArrow:
        '<button class="slick-next arrows h1 text-primary-300"><span class="icomoon icon-chevron-right"></span><span class="sr-only">Next slider</span></button>',
    })
  }
}
new SliderDemo().init()
