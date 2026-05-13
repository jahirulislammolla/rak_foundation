/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/*.blade.php",
    "./resources/**/*.blade.php",
    "./resources/**/**/*.blade.php",
    "./resources/**/**/**/*.blade.php",
    "./resources/**/**/**/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        rak: {
          navy: '#1a3c5e',
          'navy-light': '#2d5a8e',
          gold: '#c8a84b',
          teal: '#0f6e56',
          crimson: '#8b2c2c',
          cream: '#f5f2eb',
          dark: '#2c2c2c',
          muted: '#6b7280',
          card: '#ffffff',
        },
      },
      fontFamily: {
        sans: ['Inter', 'Noto Sans Bengali', 'Manrope', 'system-ui', 'sans-serif'],
        display: ['Playfair Display', 'Cormorant Garamond', 'Georgia', 'serif'],
      },
    },
  },
  plugins: [],
}
