const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/front/app.js', 'public/js/front')
    .js('resources/js/admin/app.js', 'public/js/admin')
    .sass('resources/sass/admin/style.scss', 'public/css/admin')
    .sass('resources/sass/front/app.scss', 'public/css/front');
