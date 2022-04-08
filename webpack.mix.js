const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .copy("resources/js/person/*", "public/js/person")
    .copy("resources/js/user/*", "public/js/user")
    .copy("resources/js/bond/*", "public/js/bond")
    .sass("resources/sass/app.scss", "public/css")
    .sourceMaps();
