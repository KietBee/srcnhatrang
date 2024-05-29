export default class Header {
  constructor() {
    this.header = '#header'
    this.headerMobile = '.header-mobile'
    this.mainMenu = '.main-menu'
    this.$header = $(this.header)
    this.$headerMobile = $(this.headerMobile)
    this.$mainMenu = $(this.mainMenu)
    this.numberScrol = 0
    this.lastScrollTop = 0
    this.scrollTop = 0
    this.class = 'pin-header'
    this.classMobile = 'pin-header-mobile'
  }

  init() {
    if (this.$header.length) {
      this.scrollPinHeader()
    }
  }

  scrollPinHeader() {
    this.settingPin()
    $(window).on('scroll resize orientationchange', () => {
      this.settingPin()
    })

    this.$mainMenu.on('scroll', () => {
      this.settingPinMenu()
    })
  }

  settingPin() {
    this.scrollTop = $(window).scrollTop()
    if (this.scrollTop > this.numberScrol) {
      this.$header.addClass(this.class)
    } else {
      this.$header.removeClass(this.class)
    }
    if (this.scrollTop > this.lastScrollTop) {
      this.$header.addClass('lg:hidden')
    } else {
      this.$header.removeClass('lg:hidden')
    }
    this.lastScrollTop = this.scrollTop
  }

  settingPinMenu() {
    const menuScrollTop = this.$mainMenu.scrollTop()
    if (menuScrollTop > this.numberScrol) {
      this.$headerMobile.addClass(this.classMobile)
    } else {
      this.$headerMobile.removeClass(this.classMobile)
    }
  }
}

new Header().init()
