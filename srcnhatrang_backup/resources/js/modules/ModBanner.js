export default class ModBanner {
  constructor() {
    this.$iFrame = $('#iframe-banner')
    this.isVideoReady = false
    this.$iFrame.hide()
  }

  init() {
    if (this.$iFrame.length > 0) {
      this.$iFrame.on('load', this.onIframeLoad.bind(this))
    }
  }

  onIframeLoad() {
    this.isVideoReady = true

    if (this.isVideoReady) {
      setTimeout(() => {
        this.$iFrame.show()
      }, 1000)
    }
  }
}

new ModBanner().init()
