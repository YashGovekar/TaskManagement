import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
        backgroundColor: theme => ({
            ...theme('colors'),
            green: '#239350',
            greenLight: '#ade2c3',
            primary: '#151c49',
            light: '#e1e1ef',
            lightBlue: '#e9e9f1'
        }),
        textColor: theme => ({
            ...theme('colors'),
            primary: '#1a2346'
        }),
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1280px',
        }
    },

    plugins: [forms],
};
