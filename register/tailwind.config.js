/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["public/**/*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        "custom-purple": "#9f7aea",
        "custom-pink": "#ed64a6",
        "custom-blue": "#4299e1",
        "custom-green": "#06BE18",
      },
      backgroundImage: {
        "gradient-r": "linear-gradient(to right, var(--tw-gradient-stops))",
      },
      gradientColorStops: (theme) => ({
        purple: "#9f7aea",
        pink: "#ed64a6",
        blue: "#4299e1",
        green: "#0D8F1A",
      }),
      fontFamily: {
        "chinese-rocks": ["Chinese Rocks", "sans-serif"],
      },
    },
  },
  plugins: [],
};
