/** @type {import('tailwindcss').Config} */

const colors = require("tailwindcss/colors");

module.exports = {
  content: [
    "./application/views/admin/*.php",
    "./application/views/admin/**/*.php",
    "./application/views/authentication/*.php",
    "./application/views/authentication/**/*.php",
    "./application/views/themes/**/*.php",
    "./application/views/themes/**/**/*.php",
    "./application/views/**/*.php",
    "./modules/**/views/*.php",
    "./modules/**/views/**/*.php",
    "./assets/js/main.js",
    "./assets/js/projects.js",
    "./assets/js/tickets.js",
    "./assets/js/app.js",
    "./assets/js/map.js",
    "./install/*.php",
    "./resources/js/**/*.vue"
  ],
  safelist: [
    {
      pattern:
        /^panel|btn-|bg-|text-|label-|badge-|bg-|dropdown|nav-|nav-tabs|pagination-|fc-|alert-.*/,
    },
  ],
  prefix: "tw-",
  theme: {
    extend: {
      fontSize: {
        xs: ["0.6rem", { lineHeight: "0.8rem" }],
        sm: "0.64rem",
        base: "0.72rem",
        normal: "0.675rem",
        lg: ["0.9rem", { lineHeight: "1.4rem" }],
        xl: ["1rem", { lineHeight: "1.4rem" }],
        "2xl": ["1.2rem", { lineHeight: "1.6rem" }],
        "3xl": ["1.5rem", { lineHeight: "1.8rem" }],
        "4xl": ["1.8rem", { lineHeight: "2rem" }],
        "5xl": ["2.4rem", { lineHeight: "1" }],
        "6xl": ["3rem", { lineHeight: "1" }],
        "7xl": ["3.6rem", { lineHeight: "1" }],
        "8xl": ["4.8rem", { lineHeight: "1" }],
        "9xl": ["6.4rem", { lineHeight: "1" }],
      },
      animation: {
        "spin-slow": "spin 3s linear infinite",
      },
    },
    colors: {
      transparent: "transparent",
      inherit: colors.inherit,
      current: "currentColor",

      black: colors.black,
      white: colors.white,

      neutral: colors.slate,
      danger: colors.red,
      warning: colors.yellow,
      success: colors.green,
      info: colors.sky,
      primary: colors.blue,
    },
  },
  plugins: [],
  corePlugins: {
    preflight: false,
  },
};
