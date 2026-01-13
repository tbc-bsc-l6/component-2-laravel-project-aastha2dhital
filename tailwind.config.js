import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            boxShadow: {
                soft: "0 18px 55px rgba(15, 23, 42, 0.10)",
                brand: "0 22px 55px rgba(2, 132, 199, 0.30)",
            },
        },
    },
    plugins: [],
};
