const path = require('path');
const { paths } = require('./gulpfile');
const WebpackNotifierPlugin = require('webpack-notifier');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = {
  entry: {
    main: paths.js.srcDir + 'main.js',
    admin: paths.js.srcDir + 'admin.js'
  },
  module: {
    rules: [
      {
        test: /\.jsx?$/,
        exclude: /node_modules/,
        use: [
          {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/env'],
              plugins: ['@babel/transform-runtime']
            }
          },
          {
            loader: 'eslint-loader'
          }
        ]
      }
    ]
  },
  optimization: {
    minimizer: [
      new TerserPlugin({
        // https://github.com/webpack-contrib/terser-webpack-plugin#options
        cache: true,
        parallel: true,
        extractComments: true,
        terserOptions: {
          compress: {
            drop_console: true,
          },
        }
      }),
    ]
  },
  resolve: {
    extensions: [ '.js' ]
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, paths.js.dest)
  },
  plugins: [
    new WebpackNotifierPlugin({
      skipFirstNotification: true
    }),
  ]
};
