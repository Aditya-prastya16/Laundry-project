/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./node_modules/flowbite/**/*.js","*.{html,js,php}","./auth/login.php","./layout/*.{html,php}","./kasir/*.{html,php}","./admin/*.{html,php}","./view/*.{html,php}","./admin/live-src/ajax/*.{html,php}","./owner/*.{html,php}"],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
],
}