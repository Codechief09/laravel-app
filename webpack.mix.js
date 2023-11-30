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
mix.js('resources/js/original.js', 'public/js')
	.version()
	.sass('resources/sass/app.scss', 'public/css')
	.sass('resources/sass/original.scss', 'public/css');


if (mix.inProduction()) {
    mix.version();
  }