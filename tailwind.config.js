/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
  ],
  theme: {
    extend: {
      colors: {
        primaryColor: 'rgb(0,128,0)',
        secondaryColor: 'rgb(39,39,39)',
        lightGray: 'rgb(174, 178, 183)'
      }
    },
  },
  plugins: [],
}

