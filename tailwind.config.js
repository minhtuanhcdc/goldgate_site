const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/*.blade.php',
        './resources/js/**/*.vue',
        './resources/js/**/*.black.php',

    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                'sans-Timenew': "Times New Roman",
                'sans-Arial': 'Arial',

            },
            fontWeight:{
                bold_1000:1000,
            },
            backgroundImage: {
                'logo_background': "url('/images/Logo/logoGG.png')",
                'norepeat': 'norepeat',
            },
            backgroundOpacity: {
                'opcty': '0.1',
                '20': '0.2',
                '30': '0.3',

            },
            backgroundSize: {
                'auto': 'auto',
                'cover': 'cover',
                'contain': 'contain',
                '50': '50%',
                '40': '40%',
                '30': '30%',
            },
            backdroppPacity: {
                15: '.15'
            }

        },



    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};