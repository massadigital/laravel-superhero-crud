let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
/*
 *	DROPZONE.JS 
 */
mix.copy('node_modules/dropzone/dist/dropzone.js', 'public/vendor/dropzone/dropzone.js')
.copy('node_modules/dropzone/dist/dropzone.css', 'public/vendor/dropzone/dropzone.css');
/*
 *	BOOTSTRAP-SELECT 
 */
mix.copy('node_modules/bootstrap-select/dist/js/bootstrap-select.js', 'public/vendor/bootstrap-select/js/bootstrap-select.js')
.copy('node_modules/bootstrap-select/dist/css/bootstrap-select.css', 'public/vendor/bootstrap-select/css/bootstrap-select.css');
