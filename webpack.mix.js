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

//import js files and css files from resources folder and compile them to public folder
mix.js('resources/js/app.js', 'public/js')
    .css('resources/css/app.css', 'public/css')
    .css('resources/css/mail-new-order.css', 'public/css')
