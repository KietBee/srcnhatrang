export default class ModAccordion {
  constructor() {
    this.moduleClass = '.mod-accordion'
    this.$this = $(this.moduleClass)
    this.jsClassExpand = 'js-expand'
    this.openOneClass = '.only-open-one'
    this.ariaExpanded = 'aria-expanded'
    this.animatingClass = 'animating'
  }

  handleToggle(elem) {
    const $moduleParents = $(elem).parents(this.moduleClass)
    const $content = this.findContent($(elem))

    const open = $(elem).attr(this.ariaExpanded).trim() === 'true'
    const isOnlyOpenOne = $moduleParents.is(this.openOneClass)
    const animationDuration = 400

    if (isOnlyOpenOne) {
      if (!open) {
        this.deActivate($moduleParents)
        $(elem).attr(this.ariaExpanded, 'true').addClass(this.jsClassExpand)
        $content.slideDown()
      }
    } else {
      if ($(elem).hasClass(this.animatingClass)) {
        return
      }
      if (!open) {
        $content.slideDown(animationDuration)
      } else {
        $content.slideUp(animationDuration).removeClass('hidden')
      }
      $(elem).addClass(this.animatingClass).attr(this.ariaExpanded, `${!open}`).toggleClass(this.jsClassExpand)

      // prevent multiple click events
      setTimeout(() => {
        $(elem).removeClass(this.animatingClass)
      }, animationDuration + 100)
    }
  }

  deActivate(element) {
    const $buttons = element.find('button[aria-expanded]')

    $buttons.each((_i, elem) => {
      const $elem = $(elem)
      const contentEl = this.findContent($elem)

      $elem.attr('aria-expanded', `false`).removeClass(this.jsClassExpand)
      contentEl.slideUp()
    })
  }

  findContent(btn) {
    const controlsId = btn.attr('aria-controls')
    return $(`#${controlsId}`)
  }

  addListeners(element) {
    element.find('button[aria-expanded]').each((_i, elem) => {
      $(elem).on('click', (e) => {
        if ($(e.currentTarget).is('.mouse')) {
          this.handleToggle(elem)
        }
      })

      $(elem).on('keydown', (e) => {
        this.keydownEventListener(e, elem)
      })
    })
  }

  keydownEventListener(event, element) {
    const key = event.keyCode

    switch (key) {
      case 32:
        event.preventDefault()
        this.handleToggle(element)
        break

      case 13:
        event.preventDefault()
        this.handleToggle(element)
        break

      default:
        break
    }
  }

  init() {
    if (this.$this.length) {
      this.$this.each((_index, el) => {
        this.addListeners($(el))
      })
    }
  }
}

new ModAccordion().init()
