/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./Tagebuch/*.php"],
  theme: {
    borderRadius: {
      'none': '0',
      'sm': '0.125rem',
      DEFAULT: '0.25rem',
      'md': '0.375rem',
      'lg': '0.5rem',
      'full': '9999px',
      'xl': '2rem',
    },
    extend: {},
  },
  plugins: [],
}
