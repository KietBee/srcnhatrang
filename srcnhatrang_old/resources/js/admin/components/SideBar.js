export default class SideBar {
  constructor() {
    this.$this = $('#sidebar')
    this.$openSideBar = $('#open-sidebar')
    this.$closeSideBar = $('#close-sidebar')
    this.isOpenSidebar = 'is-open-sidebar'
    this.isClosingSidebar = 'is-closing-sidebar'
    this.left = 280
  }

  init() {
    if (this.$this.length) {
      this.openSideBar()
      this.closeSideBar()
      this.clickOutside()
    }
  }

  openSideBar() {
    this.$openSideBar.on('click', () => {
        const ele = this.$this
        $(ele).addClass(this.isOpenSidebar)
        $(ele).removeClass(this.isClosingSidebar)
        $(ele).animate({ left: 0 }, 500)
        this.$openSideBar.fadeOut()
        this.$closeSideBar.fadeIn()
    })
  }

  closeSideBar() {
    this.$closeSideBar.on('click', () => {
        const ele = this.$this
        $(ele).addClass(this.isClosingSidebar)
        $(ele).removeClass(this.isOpenSidebar)
        $(ele).animate({ left: -this.left }, 500)
        this.$openSideBar.fadeIn()
        this.$closeSideBar.fadeOut()
    })
  }

  clickOutside() {
    const self = this
  
    if ($(window).width() < 1200) {
      $(document).on('click', function(event) {
        if (!$(event.target).closest(self.$openSideBar).length) {
          const ele = self.$this
          $(ele).addClass(self.isClosingSidebar)
          $(ele).removeClass(self.isOpenSidebar)
          $(ele).animate({ left: -self.left }, 500)
          self.$openSideBar.fadeIn()
          self.$closeSideBar.fadeOut()
        }
      })
    }
  }
}

new SideBar().init()
