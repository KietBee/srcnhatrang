import Swiper from 'swiper'
import { Navigation, Autoplay, Keyboard, A11y } from 'swiper/modules'

export default class ModTestimonialCarousel {
  constructor() {
    this.$el = $('.mod-testimonial-carousel')
  }

  init() {
    if (this.$el.length) {
      this.addSwiper()
    }
  }

  addSwiper() {
    new Swiper(this.$el.find('.testimonial-carousel')[0], {
      modules: [Navigation, Autoplay, Keyboard, A11y],
      loop: true,
      lazy: true,
      slidesPerView: 'auto',
      mousewheel: true,
      navigation: {
        nextEl: this.$el.find('.swiper-button-next')[0],
        prevEl: this.$el.find('.swiper-button-prev')[0],
      },
      autoplay: {
        delay: 100000,
        disableOnInteraction: false,
      },
      keyboard: {
        enabled: true,
      },
      a11y: {
        enabled: true,
        prevSlideMessage: 'Previous slide',
        nextSlideMessage: 'Next slide',
        firstSlideMessage: 'This is the first slide',
        lastSlideMessage: 'This is the last slide',
      },
      on: {
        slideChange: (event) => {
          console.log(event)
          console.log(event.activeIndex)
        },
      },
    })
  }
}
new ModTestimonialCarousel().init()
