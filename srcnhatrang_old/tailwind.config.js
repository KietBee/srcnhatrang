/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        primary: {"50":"#f0fdf4","100":"#dcfce7","200":"#bbf7d0","300":"#86efac","400":"#4ade80","500":"#22c55e","600":"#16a34a","700":"#15803d","800":"#166534","900":"#14532d","950":"#052e16"}
      }
    },
    // colors: {
    //   primary: {
    //     100: 'var(--primary-100)',
    //     200: 'var(--primary-200)',
    //     300: 'var(--primary-300)',
    //     400: 'var(--primary-400)',
    //     500: 'var(--primary-500)',
    //     600: 'var(--primary-600)',
    //     700: 'var(--primary-700)',
    //     800: 'var(--primary-800)',
    //     900: 'var(--primary-900)'
    //   },
    //   secondary: {
    //     100: 'var(--secondary-100)',
    //     200: 'var(--secondary-200)',
    //     300: 'var(--secondary-300)',
    //     400: 'var(--secondary-400)',
    //     500: 'var(--secondary-500)',
    //     600: 'var(--secondary-600)',
    //   },
    //   tertiary: {
    //     100: 'var(--tertiary-100)',
    //     200: 'var(--tertiary-200)',
    //     300: 'var(--tertiary-300)',
    //     400: 'var(--tertiary-400)',
    //     500: 'var(--tertiary-500)',
    //   },
    //   states: {
    //     100: 'var(--states-100)',
    //     200: 'var(--states-200)',
    //     300: 'var(--states-300)'
    //   },
    //   gray: {
    //     100: 'var(--gray-100)',
    //     200: 'var(--gray-200)',
    //     300: 'var(--gray-300)',
    //     400: 'var(--gray-400)',
    //     500: 'var(--gray-500)',
    //     600: 'var(--gray-900)',
    //   },
    //   black: 'var(--black)',
    //   white: 'var(--white)',
    //   transparent: 'var(--transparent)'
    // },
    fontFamily: {
      'body': [
      'Roboto', 
      'ui-sans-serif', 
      'system-ui', 
      '-apple-system', 
      'system-ui', 
      'Segoe UI', 
      'Roboto', 
      'Helvetica Neue', 
      'Arial', 
      'Noto Sans', 
      'sans-serif', 
      'Apple Color Emoji', 
      'Segoe UI Emoji', 
      'Segoe UI Symbol', 
      'Noto Color Emoji'
    ],
      'sans': [
      'Roboto', 
      'ui-sans-serif', 
      'system-ui', 
      '-apple-system', 
      'system-ui', 
      'Segoe UI', 
      'Roboto', 
      'Helvetica Neue', 
      'Arial', 
      'Noto Sans', 
      'sans-serif', 
      'Apple Color Emoji', 
      'Segoe UI Emoji', 
      'Segoe UI Symbol', 
      'Noto Color Emoji'
    ]
    },
    zIndex: {
      ...defaultTheme.zIndex,
      '9999': '9999',
    },
    screens: {
      'sm': '481px',
      'md': '768px',
      'lg': '992px',
      'xl': '1200px',
      '2xl': '1440px',
      '3xl': '1600px',
      '2k': '2000px',
      'down_2xl': {'max': '1439.9px'},
      'down_xl': {'max': '1199.9px'},
      'down_lg': {'max': '991.9px'},
      'down_md': {'max': '767.9px'},
      'down_sm': {'max': '480.9px'},
      'down_xs': {'max': '413.9px'},
    }
  },
  plugins: [
    require('flowbite/plugin'),
    function ({ addComponents }) {
      addComponents({
        '.container': {
          width: '100%',
          marginLeft: 'auto',
          marginRight: 'auto',
          paddingLeft: '24px',
          paddingRight: '24px',
          '@screen md': {
            paddingLeft: '48px',
            paddingRight: '48px',
          },
          '@screen lg': {
            maxWidth: '1000px',
          },
          '@screen xl': {
            maxWidth: '1240px',
          },
          '@screen 2xl': {
            maxWidth: '1440px'
          }
        },
      })
    }
  ],
}