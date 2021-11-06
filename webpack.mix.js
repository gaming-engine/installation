const mix = require('laravel-mix');
const webpack = require('webpack');
const path = require('path');

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

const environment = mix.inProduction() ? 'prod' : 'local';

const options = {
  terser: {
    terserOptions: {
      compress: {
        drop_console: true,
      },
    },
  },
};

if (process.env.HOT_RELOAD_DOMAIN) {
  options.hmrOptions = {
    host: process.env.HOT_RELOAD_DOMAIN,
    port: process.env.HOT_RELOAD_PORT,
  };
}

mix.options(options).extract()
  .setPublicPath(`dist/${environment}`)
  .js('resources/js/app.js', '/js')
  .vue()
  .version()
  .webpackConfig({
    resolve: {
      symlinks: false,
      alias: {
        '@mixins': path.resolve(__dirname, 'resources/js/mixins'),
        '@components': path.resolve(__dirname, 'resources/js/components'),
      },
    },
    plugins: [new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)],
  });
