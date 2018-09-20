'use strict';

const NODE_ENV = process.env.NODE_ENV || 'development';
const webpack = require('webpack');
const path = require('path');

module.exports = {
  context: path.join(__dirname, '/resources/assets/js'),
  entry: {
    'app': './app',
  },
  output: {
    path: path.join(__dirname, '/public/dist/js'),
    filename: '[name].js',
    publicPath: "/dist/js/"
  },
  resolve: {
    modules: [
      'node_modules',
      path.join(__dirname, '/public/lib'),
    ],
    alias: {
      bootstrap: 'bootstrap.min.js',
      fileupload: 'jquery-file-upload-9.19.0/js/jquery.fileupload',
    }
  },
  plugins: [
    new webpack.ProvidePlugin({
      Popper: ['popper.js', 'default'],
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
    }),
  ],
  module: {
    loaders: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['babel-preset-env']
          }
        }
      }
    ]
  },
  externals: {
    ymaps: 'ymaps'
  },
  watch: NODE_ENV === 'development',
  devtool: 'source-map'
};

if (NODE_ENV === 'production') {
  console.log('here');
  module.exports.plugins.push(
    new webpack.optimize.UglifyJsPlugin({
      output: {comments: false},
      compress: {
        warnings: false,
        drop_console: true,
        unsafe: true
      }
    })
  )
}