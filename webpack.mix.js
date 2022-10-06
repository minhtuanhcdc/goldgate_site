const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
    mix.version();
}
const webpack = require('webpack')

// module.exports = {
//     // ...
//     externals: {
//         // only define the dependencies you are NOT using as externals!
//         canvg: "canvg",
//         html2canvas: "html2canvas",
//         dompurify: "dompurify"
//     }
// };

// mix.webpackConfig({
//     stats: {
//         children: true,
//     },
// });