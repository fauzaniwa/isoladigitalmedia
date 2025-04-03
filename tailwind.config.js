/** @type {import('tailwindcss').Config} */

export default {
  content: ["./src/**/*.{html,js,jsx,ts,tsx}"], // Path diperbaiki
  theme: {
    extend: {
      fontFamily: {
        bolo: ["'Bolota'", "sans-serif"],
        chill: ["'Chillax'", "sans-serif"],
        out: ["'Outfit'", "sans-serif"],
      },
    },
  },
  plugins: [],
};
