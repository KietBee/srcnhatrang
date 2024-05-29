export default class ModCarouselSlide {
  constructor() {
    this.$this = $('.mod-slider-ada')
    this.slidesItemsClass = '.slider-items'
    this.sliderItemWrapper = '.slider-item-wrapper'
    this.sliderItemLinkClass = '.slider-item-link'
    this.disabledFocusClass = 'disable-focus'
    this.rotationBtnClass = 'slider-rotation'
    this.isRotatingClass = 'is-rotating'
    this.autoplay = '.auto-play'
    this.ariaLabel = 'aria-label'
    this.isFocusin = false

    this.keys = {
      tab: 9,
      space: 32,
      enter: 13,
      right: 39,
      left: 37,
    }
  }

  addSlick(sliderEl) {
    const number = sliderEl.is('.option-1') ? 3 : 1
    const $slider = sliderEl.find('.slider')
    const $slideItem = sliderEl.find('.slider-item')
    const isAutoPlaySlide = sliderEl.is(this.autoplay)
    const sliderId = $slider.attr('id')
    $slider.on('init', () => {
      this.changeAriaLabel($slider)
    })
    $slider.slick({
      slidesToShow: number,
      rows: 0,
      appendArrows: sliderEl.find('.controls'),
      autoplay: isAutoPlaySlide,
      prevArrow: `
      <button type="button" class="previous slick-prev arrows h1 text-primary-300 hover:text-primary-400" aria-controls="${sliderId}">
      <span class="icomoon icon-chevron-left"></span>
      <span class="sr-only">Previous Slide</span>
      </button>
      `,
      nextArrow: `
      <button type="button" class="previous slick-next arrows h1 text-primary-300 hover:text-primary-400" aria-controls="${sliderId}">
      <span class="icomoon icon-chevron-right"></span>
      <span class="sr-only">Next slider</span>
      </button>
      `,
      dots: true,
      appendDots: sliderEl.find('.controls-dots'),
      responsive: sliderEl.is('.option-1') && [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    })

    $slider.find('.slick-cloned').removeAttr(this.ariaLabel)
    $slider.on('afterChange', (_event, _slick, currentSlide) => {
      const $currentSlideEl = $($slideItem[currentSlide])
      this.deActiveFocus(sliderEl)
      // remove focus all slides then active focus on current slide
      if (!sliderEl.is('.option-1')) {
        $slideItem.find(this.sliderItemWrapper).attr('tabindex', -1)
        $currentSlideEl.find(this.sliderItemWrapper).attr('tabindex', 0)
      }

      setTimeout(() => {
        this.deActiveFocus(sliderEl)
        this.changeAriaLabel($slider)
      }, 1)
    })
  }

  addAriaLive(slideEl, isFocusin = false, isOutFocusin = null) {
    const isAutoPlaySlide = slideEl.is(this.autoplay)
    const $slider = slideEl.find('.slider')
    if (isOutFocusin) {
      if (isAutoPlaySlide) {
        const hadFocus = $slider.attr('aria-live') === 'polite'
        // back to off then out of focus
        if (hadFocus) {
          $slider.attr('aria-live', 'off')
        }
      }
      return false
    }
    if (isFocusin) {
      return isAutoPlaySlide && $slider.attr('aria-live', 'polite')
    }
    if (isAutoPlaySlide) {
      $slider.attr('aria-live', 'off')
    } else {
      $slider.attr('aria-live', 'polite')
    }
    return false
  }

  addListeners(slides) {
    const $slider = slides.find('.slider')
    const $slideItem = $slider.find('.slider-item')
    const $rotationItem = $slider.find('.slider-rotation')

    $slider.on('keydown', (e) => {
      this.keydownEventListener(e, $slider)
    })

    $slideItem.on('focusin', () => {
      this.deActiveFocus($slider)
      this.addAriaLive($slider, true)
    })

    $slideItem.on('focusout', () => {
      this.addAriaLive($slider, null, true)
    })

    $rotationItem.on('keydown', (e) => {
      if (e.keyCode === this.keys.enter || e.keyCode === this.keys.space) {
        e.preventDefault()
        this.handleToggleRotation($rotationItem, $slider)
      }
    })

    $rotationItem.on('click', (e) => {
      e.preventDefault()
      this.handleToggleRotation($rotationItem, $slider)
    })
  }

  setUpAriaLabelForRotation(sliderEl, isRotating = true) {
    const stopLabel = 'Stop automatic slide show'
    const startLabel = 'Start automatic slide show'

    if (sliderEl.is(this.autoplay)) {
      const $rotationBtn = sliderEl.find(`.${this.rotationBtnClass}`)
      $rotationBtn.attr(this.ariaLabel, isRotating ? stopLabel : startLabel)
    }
  }

  handleToggleRotation(rotationItem, sliderEl) {
    const $slider = sliderEl.find('.slider')
    rotationItem.toggleClass(this.isRotatingClass)

    if (rotationItem.hasClass(this.isRotatingClass)) {
      $slider.slick('slickPlay')
      this.addAriaLive(sliderEl, null, true)
      this.setUpAriaLabelForRotation(sliderEl, true)
    } else {
      $slider.slick('slickPause')
      this.addAriaLive(sliderEl, true)
      this.setUpAriaLabelForRotation(sliderEl, false)
    }
  }

  keydownEventListener(event, slides) {
    const key = event.keyCode

    switch (key) {
      case this.keys.left:
        event.preventDefault()
        slides.prev()
        break

      case this.keys.right:
        event.preventDefault()
        slides.next()
        break

      default:
        break
    }
  }

  changeAriaLabel(slider) {
    slider
      .parent()
      .find('.slick-dots button')
      .each((index, ele) => {
        index += 1
        const label = `Slide ${index}`
        $(ele).attr(this.ariaLabel, label)
      })
  }

  deActiveFocus(sliderEl) {
    // dots
    const $dots = sliderEl.find('.slick-dots button')
    if ($dots.length) {
      $dots.attr({
        tabindex: -1,
      })
    }

    // click cloned
    const $slickCloned = sliderEl.find('.slick-slide.slick-cloned')
    if ($slickCloned.length) {
      $slickCloned.find(this.sliderItemWrapper).attr('tabindex', -1)
    }

    // arrows
    if (!sliderEl.hasClass('allow-tab-btn')) {
      const $arrows = sliderEl.find('.slick-arrow')
      if ($arrows.length) {
        $arrows.attr('tabindex', -1)
      }
    }

    // disabled focus links
    const $disabledFocus = sliderEl.find(`.${this.disabledFocusClass}`)
    if ($disabledFocus.length) {
      $disabledFocus.attr('tabindex', -1)
    }
  }

  init() {
    if (this.$this.length) {
      this.$this.each((_i, ele) => {
        const $ele = $(ele)
        this.addSlick($ele)
        this.deActiveFocus($ele)
        this.addListeners($ele)
        this.addAriaLive($ele)
        this.setUpAriaLabelForRotation($ele)
      })
    }
  }
}

new ModCarouselSlide().init()
