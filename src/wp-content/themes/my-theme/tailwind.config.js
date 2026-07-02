/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./templates/**/*.php",

    // 独自プラグインのCSS管理もここでしている
    "../../plugins/my-plugin/templates/**/*.php",
    "!../../plugins/my-plugin/templates/admin/**/*.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
