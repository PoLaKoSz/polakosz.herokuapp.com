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

mix.js('resources/js/app.js', 'public/js')
   .sourceMaps()
   .extract(['axios', 'bootstrap', 'bootstrap-datepicker', 'jquery', 'lodash'])

   .sass('resources/sass/app.scss', 'public/css')
   .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css')
   .copy('node_modules/bootstrap/dist/css/bootstrap.min.css.map', 'public/css')
   .sass('resources/sass/mdb.scss', 'public/css')

   .version();
