/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors');

module.exports = {
  purge: false,
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        "text-default": "#A36361", 
        "text-secondary": "#F0F0F0",
      },
    },
  },
  plugins: [
    require('flowbite/plugin'),
  ],
};
