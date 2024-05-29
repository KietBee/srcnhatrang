export default class Typography {
  constructor() {
    this.$typography = $('.js-typography')
    this.$themeColor = $('#js-color')
    this.cssFilePathMain = [$('link[rel="stylesheet"][href*="assets/styles/app.css"]').attr('href')]
  }

  init() {
    if (this.$typography.length) {
      this.getTypography()
    }
    if (this.$themeColor.length) {
      this.cssFilePathMain.forEach(this.processCssFile)
    }
  }

  getTypography() {
    this.$typography.find(':header, p, li').each((_index, e) => {
      const $this = $(e)
      const tagName = $this.prop('tagName')
      const fontSize = $this.css('font-size')
      const lineHeight = $this.css('line-height')
      const fontFamily = $this.css('font-family')
      const fontWeight = $this.css('font-weight')
      let color = $this.css('color')
      color = this.rgbToHex(color)
      const letterSpacing = $this.css('letter-spacing')
      const wordSpacing = $this.css('word-spacing')
      const cssText = `size: ${fontSize}; family: ${fontFamily}; weight: ${fontWeight}; line-height: ${lineHeight};  color: ${color}; letter-spacing: ${letterSpacing}; word-spacing: ${wordSpacing};`
      $this.append(
        `<span class=""> ${tagName}: <span class="text-primary-300 font-normal inline-block text-base px-3 border border-primary-300">${cssText}</span></span>`,
      )
    })
  }

  rgbToHex(rgb) {
    const hex = rgb.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*([\d.]+))?\)$/)
    if (!hex) {
      return null
    }
    const r = parseInt(hex[1], 10).toString(16).padStart(2, '0')
    const g = parseInt(hex[2], 10).toString(16).padStart(2, '0')
    const b = parseInt(hex[3], 10).toString(16).padStart(2, '0')
    return `#${(r, g, b)}`
  }

  processCssFile(filePath) {
    fetch(filePath)
      .then((response) => response.text())
      .then((cssContent) => {
        const colorMatchesVa = cssContent.match(/var\(--([a-zA-Z0-9-]+)\)/g)
        const regex = /--([a-zA-Z0-9-]+):\s*#([0-9a-fA-F]{3,6});/g

        let match
        let $listColor
        // eslint-disable-next-line no-cond-assign
        while ((match = regex.exec(cssContent)) !== null) {
          const variableName = match[1]
          if (!variableName.includes('tw-')) {
            let color = `#${match[2]}`
            $listColor = $('<li>')
              .append(`<span>Name: --${variableName}<br>Color: ${color}</span>`)
              .addClass('py-3 px-5 border border-tertiary-300 inline-block w-full')
            color = color.trim()
            if (color.length === 4) {
              color = `#${(color[1], color[2], color[2], color[3], color[3])}`
            }
            const r = parseInt(color.slice(1, 3), 16)
            const g = parseInt(color.slice(3, 5), 16)
            const b = parseInt(color.slice(5, 7), 16)
            const brightness = (r * 299 + g * 587 + b * 114) / 1000

            if (brightness < 128 || color === '#000' || variableName === 'black') {
              $listColor.find('span').addClass('text-white')
            }
            $listColor.css('background-color', color)
            if (color === '#000' || variableName === 'black') {
              $listColor.css('background-color', '#000')
            }
            $('#js-color2').append($listColor)
          }
        }
        const colorVariables = {}
        let $listItemVar

        const colorPattern = /#(?:[0-9a-fA-F]{3}){1,2}(?![a-zA-Z0-9-_:])/g
        const colorMatches = cssContent.match(colorPattern)
        const colorCounts = colorMatches.reduce((counts, color) => {
          counts[color] = (counts[color] || 0) + 1
          return counts
        }, {})

        if (colorMatchesVa) {
          colorMatchesVa.forEach((matchValue) => {
            const colorVariable = matchValue.match(/var\(--([a-zA-Z0-9-]+)\)/)[1]
            // console.log(colorVariable)
            if (colorVariables[colorVariable]) {
              colorVariables[colorVariable]++
            } else {
              colorVariables[colorVariable] = 1
            }
          })
        }
        const colorArray = Object.keys(colorVariables).map((variable) => ({
          variable,
          count: colorVariables[variable],
        }))

        colorArray.sort((a, b) => b.count - a.count)

        // console.log(colorVariables)
        colorArray.forEach((item) => {
          let color = getComputedStyle(document.documentElement).getPropertyValue(`--${item.variable}`).trim()
          if (color.length > 3 && item.variable !== 'tw-shadow') {
            $listItemVar = $('<li>')
              .append(`<span>Name: --${item.variable}<br>Color: ${color}<br>Count: ${item.count}</span>`)
              .addClass('py-3 px-5 border border-tertiary-300 inline-block w-full')
            color = color.trim()
            if (color.length === 4) {
              color = `#${(color[1], color[2], color[2], color[3], color[3])}`
            }
            const r = parseInt(color.slice(1, 3), 16)
            const g = parseInt(color.slice(3, 5), 16)
            const b = parseInt(color.slice(5, 7), 16)
            const brightness = (r * 299 + g * 587 + b * 114) / 1000

            if (brightness < 128 || color === '#000' || item.variable === 'black') {
              $listItemVar.find('span').addClass('text-white')
            }
            $listItemVar.css('background-color', color)
            if (color === '#000' || item.variable === 'black') {
              $listItemVar.css('background-color', '#000')
            }
            $('#js-color').append($listItemVar)
          }
        })

        const sortedColors = Object.entries(colorCounts).sort((a, b) => b[1] - a[1])
        sortedColors.forEach(([color, count]) => {
          if (color === '#f' || color === '#fff' || color === '#9ca3af') {
            count -= 4
          }
          if (count > 1) {
            const $listItem = $('<li>')
              .append(`<span>Color: ${color}<br>Count: ${count}</span>`)
              .addClass('py-3 px-5 border border-tertiary-300 inline-block w-full')
            color = color.trim()
            if (color.length === 4) {
              color = `#${(color[1], color[2], color[2], color[3], color[3])}`
            }
            const r = parseInt(color.slice(1, 3), 16)
            const g = parseInt(color.slice(3, 5), 16)
            const b = parseInt(color.slice(5, 7), 16)
            const brightness = (r * 299 + g * 587 + b * 114) / 1000
            if (brightness < 128 || color === '#0' || color === 'black') {
              $listItem.find('span').addClass('text-white')
            }
            $listItem.css('background-color', color)
            if (color === '#0' || color === 'black') {
              $listItem.css('background-color', '#000')
            }
            $('#js-color-no-variable').append($listItem)
          }
          if ($('#js-color-no-variable').find('li').length === 0) {
            $('.color-no-variable').addClass('hidden')
          }
        })
      })
      .catch((error) => {
        console.error('Error reading CSS file:', error)
      })
  }
}
new Typography().init()
