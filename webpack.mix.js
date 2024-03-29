let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
require('laravel-mix-purgecss');

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

mix.js('resources/assets/js/app.js', 'public')
   .js('resources/assets/js/sales.js', 'public')
   .sass('resources/assets/sass/app.scss', 'public')
   .copyDirectory('./node_modules/font-awesome/fonts', 'public/fonts')
   .copyDirectory('./node_modules/tinymce/skins/lightgray/fonts', 'public/fonts')
   .copyDirectory('./node_modules/tinymce/skins/lightgray', 'public/tinymce')
   .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.js') ],
   })
   .disableSuccessNotifications();

if (mix.inProduction()) {
    mix.version().purgeCss();
}
