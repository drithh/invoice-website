const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
  ],

  theme: {
    extend: {
      colors: {
        primary: {
          background: "#F0F4FC",
          textdark: "#3F4254",
          textgray: "#626679",
          purple: "#7F2987",
          darkpink: "#F0517A",
          warmpink: "#F26689",
          warmred: "#D51C53",
          darkred: "#BC2228",
          blue: "#459ED8",
          warmblue: "#2390CF",
          orange: "#F79747",
          cyan: "#23A7AC",
          green: "#14A54D",
        },
        tag: {},
      },
      fontFamily: {
        montserrat: ["Montserrat", ...defaultTheme.fontFamily.sans],
        poppins: ["Poppins", ...defaultTheme.fontFamily.sans],
      },
    },
  },

  plugins: [
    require("tailwindcss-plugins/pagination"),
    require("@tailwindcss/forms"),
  ],
};
