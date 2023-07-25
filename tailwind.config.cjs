const packageJson = require('./package.json');

/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ['./resources/**/*{js,ts,vue}'],
  theme: {
    extend: {},
  },
  plugins: [],
  important: `.${packageJson.name.toLowerCase().match(/(\/|^)([^/]+)$/)?.[2] ?? 'not-defined'}`,
};
