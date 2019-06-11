
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

const mix = require('laravel-mix')

mix.disableNotifications()

mix
  .js('resources/scripts/libs.js', 'js/libs.js')
  .sass('resources/styles/libs.scss', 'css/libs.css')
