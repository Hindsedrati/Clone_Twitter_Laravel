import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import aspectratio from '@tailwindcss/aspect-ratio';
import dropdown from 'tailwindcss-dropdown';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        display: ['dropdown']
    },

    plugins: [forms, aspectratio, dropdown],
};
