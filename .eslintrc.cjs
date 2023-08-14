module.exports = {
  root: true,
  env: {
    node: true,
    browser: true,
    es2020: true,
    jest: true,
  },
  extends: [
    'eslint:recommended',
    'plugin:vue/vue3-recommended',
    '@vue/eslint-config-typescript/recommended',
    '@vue/eslint-config-prettier',
  ],
  rules: {
    'vue/no-v-text-v-html-on-component': 0,
    'vue/no-v-html': 0,
  },
  ignorePatterns: ['node_modules/', 'vendor/', 'dist/'],
};
