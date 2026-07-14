/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./templates/**/*.php",
    "./resources/**/*.{js,ts,vue}",

    // 独自プラグインのCSS管理もここでしている
    "../../plugins/my-plugin/views/**/*.php",
    "!../../plugins/my-plugin/views/admin/**/*.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
