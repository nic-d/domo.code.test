/*
** TailwindCSS Configuration File
**
** Docs: https://tailwindcss.com/docs/configuration
** Default: https://github.com/tailwindcss/tailwindcss/blob/master/stubs/defaultConfig.stub.js
*/
module.exports = {
  purge: [],
  theme: {
    extend: {
      fontFamily: {
        'sans': ['Mulish', 'Helvetica', 'Arial', 'sans-serif']
      }
    },
    colors: {
      transparent: 'transparent',
      black: '#001123',
      white: '#fff',
      charcoal: {
        100: '#6b7594',
        200: '#495065',
        300: '#292d38',
        400: '#15171e',
        500: '#060709',
      },
      gray: {
        100: '#f7f7f8',
        200: '#dedee3',
        300: '#c2c2cb',
        400: '#a7a7b4',
        500: '#8b8b9c',
      },
      indigo: {
        100: '#F1EEFF',
        200: '#DBD3FF',
        300: '#C5B9FF',
        400: '#9A85FF',
        500: '#6F50FF',
        600: '#6448E6',
        700: '#433099',
        800: '#322473',
        900: '#21184D',
      },
      green: {
        50: '#F5FCFA',
        100: '#ECF8F4',
        200: '#CFEEE4',
        300: '#B2E3D3',
        400: '#78CEB2',
        500: '#3EB991',
        600: '#38A783',
        700: '#256F57',
        800: '#1C5341',
        900: '#13382C',
      },
      blue: {
        50: '#F5FCFE',
        100: '#EBF9FE',
        200: '#CDF1FB',
        300: '#AFE8F9',
        400: '#72D6F5',
        500: '#36C5F0',
        600: '#31B1D8',
        700: '#207690',
        800: '#18596C',
        900: '#103B48',
      },
      orange: {
        50: '#FEFBF4',
        100: '#FDF6E9',
        200: '#FAE9C7',
        300: '#F6DCA6',
        400: '#F0C263',
        500: '#E9A820',
        600: '#D2971D',
        700: '#8C6513',
        800: '#694C0E',
        900: '#46320A',
      },
      red: {
        50: '#FDF3F7',
        100: '#FCE8EF',
        200: '#F7C5D8',
        300: '#F3A1C1',
        400: '#E95B92',
        500: '#E01563',
        600: '#CA1359',
        700: '#860D3B',
        800: '#65092D',
        900: '#43061E',
      },
      aubergine: {
        50: '#F6F3F6',
        100: '#EDE8ED',
        200: '#D2C5D2',
        300: '#B7A1B7',
        400: '#805B81',
        500: '#4A154B',
        600: '#431344',
        700: '#2C0D2D',
        800: '#210922',
        900: '#160617',
      },
    },
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ],
}
