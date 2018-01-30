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

mix.webpackConfig({
    resolve: {
        alias: {
            jquery: "jquery/src/jquery"
        }
    }
});

mix.js('resources/assets/js/app.js', 'public/js')
    .extract(['jquery', 'lodash', 'bootstrap-sass'])
    .sass('resources/assets/sass/app.scss', 'public/css');

mix.styles([
    'resources/assets/css/*.css'
], 'public/css/styles.css');

mix.scripts([
    'resources/assets/js/adminlte.min.js',
    'resources/assets/js/icheck.min.js',
    'resources/assets/js/bootstrap3-wysihtml5.all.min.js'
], 'public/js/plugins.js');


mix.copyDirectory('resources/assets/img', 'public/img');