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

    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
     })
     mix.copy('node_modules/@fortawesome/fontawesome-free/scss', 'public/css/fontawesome')
    .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css')
    .copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/js')
    .copy('node_modules/jquery/dist/jquery.min.js', 'public/js')
    .copy('node_modules/popper.js/dist/umd/popper.min.js', 'public/js')

    //.browserSync('http://prag-weathers.local'); 
    mix.autoload({
        'jquery': ['$', 'window.jQuery', "jQuery", "window.$", "jquery", "window.jquery"],
        'popper.js/dist/umd/popper.js': ['Popper', 'window.Popper']
    });
    
    // Run the Laravel Mix build
mix.version();