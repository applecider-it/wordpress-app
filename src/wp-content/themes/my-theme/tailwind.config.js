/** @type {import('tailwindcss').Config} */
module.exports = {
  content: {
    files: ['./**/*.{php,js}', '../../plugins/my-plugin/templates/**/*.php'],
    exclude: ['../../plugins/my-plugin/templates/admin/**/*.php'],
  },
  theme: {
    extend: {},
  },
  plugins: [],
};
