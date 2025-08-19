/** @type {import('tailwindcss').Config} */
module.exports = {
 content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        lato: ['Lato', 'sans-serif'],
      },
    },
  },
  plugins: [
      require('@tailwindcss/typography'),
  ],
}

