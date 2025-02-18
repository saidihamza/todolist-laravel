const mix = require('laravel-mix');
require('postcss-import');
require('tailwindcss');

mix
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/custom.scss', 'public/css')
    .sourceMaps(); // Correctement positionné et sans point-virgule en trop
