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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .copy('resources/admin/plugins', 'public/admin/js')
    .copy('resources/admin/dist/img', 'public/admin/dist/img')
    .copy('resources/admin/dist/js/adminlte.js', 'public/admin/dist/js')
    .copy('resources/admin/dist/js/pages/dashboard2.js', 'public/admin/dist/js/pages')
    .css('resources/admin/dist/css/adminlte.min.css', 'public/admin/dist/css');
