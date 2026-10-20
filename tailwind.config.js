import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                swiss: {
                    bg: '#191919',
                    surface: '#242424',
                    'surface-elevated': '#2c2c2c',
                    primary: '#F0EEE8',
                    secondary: '#929292',
                    accent: '#758268',
                    'accent-light': '#8a997a',
                    'accent-dark': '#5e6953',
                    border: '#353535',
                    'border-light': '#454545',
                },
            },
        },
    },

    plugins: [forms,require('flowbite/plugin'),],
};
