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
    .sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/fontawesome.scss', 'public/css');
// Template styles
mix.styles([
    'node_modules/startbootstrap-sb-admin/css/sb-admin.css',
    'node_modules/startbootstrap-sb-admin/css/sb-admin.min.css',
    'node_modules/startbootstrap-sb-admin/vendor/fontawesome-free/css/all.min.css',
    'node_modules/startbootstrap-sb-admin/vendor/datatables/dataTables.bootstrap4.css'
], 'public/css/external.css');


// Template dependencies
mix.scripts([
    'node_modules/startbootstrap-sb-admin/vendor/jquery-easing/jquery.easing.min.js',
    'node_modules/startbootstrap-sb-admin/vendor/jquery/jquery.min.js',
    'node_modules/startbootstrap-sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js',
    'node_modules/startbootstrap-sb-admin/js/sb-admin.js',
    'node_modules/startbootstrap-sb-admin/js/sb-admin.min.js',
    'node_modules/startbootstrap-sb-admin/js/demo/chart-area-demo.js',
    'node_modules/startbootstrap-sb-admin/js/demo/datatables-demo.js',
    'node_modules/startbootstrap-sb-admin/vendor/datatables/jquery.dataTables.js',
    'node_modules/startbootstrap-sb-admin/vendor/chart.js/Chart.min.js',
], 'public/js/external.js');