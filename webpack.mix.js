const mix = require('laravel-mix');

mix.autoload({
    jquery: ['$', 'window.jQuery']
});

mix.js('resources/js/app.js', 'public/js');