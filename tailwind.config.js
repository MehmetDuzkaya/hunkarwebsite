/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        'gold': '#D4AF37',
        'pistachio': '#93C572',
        'coffee': '#645b49',
        'sand': '#DEDCD3',
      }
    },
  },
  plugins: [],
}
