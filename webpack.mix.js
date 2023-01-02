let mix = require('laravel-mix');

require('mix-tailwindcss');

mix.postCss('resources/assets/css/app.css', 'resources/dist/css')
   .tailwind()

