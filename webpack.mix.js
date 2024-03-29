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
   .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .version();

// mix.browserSync('admin.laravelvue.test');

mix.js('resources/js/admin.js','public/js')
    .extract(['vue'])
    .sourceMaps()
    .version();



mix.js('resources/js/organization.js','public/js')
    .version();
