/** @type {import('tailwindcss').Config} */
module.exports = {
  // 独自プラグインのCSS管理もここでしている
  content: {
    files: ['./**/*.{php,js}', '../../plugins/my-plugin/templates/**/*.php'],
    exclude: ['../../plugins/my-plugin/templates/admin/**/*.php'],
  },
  theme: {
    extend: {},
  },
  plugins: [],
};
