import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
require("dotenv").config();

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    darkMode: "class",

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                white: "#dfdfdf",
                black: "#202020",
            },
            backgroundImage: (theme) => ({
                light: `url(${process.env.APP_URL}${process.env.BG_LIGHT_IMAGE})`,
                dark: `url(${process.env.APP_URL}${process.env.BG_DARK_IMAGE})`,
            }),
        },
    },

    plugins: [forms],
};
