
 /** @type {import('tailwindcss').Config} */
 export default {
  content: ["./*.html", "./js/**/*.js"],

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
}

