import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'html',
    content: [
        '../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        '../storage/framework/views/*.php',
        '../resources/**/*.blade.php',
        '../resources/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Lato', ...defaultTheme.fontFamily.serif],
            },
        },
    },
    plugins: [],
};
