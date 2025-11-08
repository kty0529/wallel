module.exports = {
  env: { browser: true, node: true, es6: true },
  extends: ["eslint:recommended"],
  parserOptions: { ecmaVersion: 2021, sourceType: "script" },
  globals: { __: "writable" },
  rules: {
    quotes: ["error", "double"],
    semi: ["error", "always"],
    indent: ["error", 2],
    "no-var": "error",
    "prefer-const": "error",
    eqeqeq: "error",
    "no-unused-vars": ["warn", { argsIgnorePattern: "^_", varsIgnorePattern: "^_$" }],
    "no-console": ["warn", { allow: ["warn", "error"] }],
  },
};
