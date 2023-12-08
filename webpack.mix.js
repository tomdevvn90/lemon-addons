const mix = require('laravel-mix');
mix.setPublicPath('dist');
mix.setResourceRoot('../');
mix.autoload({
   jquery: ['$', 'jQuery', 'window.jQuery']
});
mix.copyDirectory('/assets/images', 'dist/images');
mix.js('assets/js/plugin.js', 'dist/js')
   .sass('assets/scss/plugin.scss', 'dist/css')
   .extract()
   .version();