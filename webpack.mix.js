let mix = require('laravel-mix');

require('mix-tailwindcss');

mix.postCss('resources/assets/css/app.css', 'resources/dist/css')
   .tailwind()

mix.combine(['resources/assets/js/init-alpine.js', 'resources/assets/js/prism.js'], 'resources/dist/js/banner-manager.js');
mix.minify('resources/dist/js/smart-banner.js');
