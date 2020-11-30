const autoprefixer = require('autoprefixer');
const cache = require('gulp-cache');
const cleanCSS = require('gulp-clean-css')
const del = require('del');
const gulp = require('gulp');
const gulpif = require('gulp-if');
const imagemin = require('gulp-imagemin');
const modernizr = require('gulp-modernizr');
const notify = require('gulp-notify');
const postcss = require('gulp-postcss');
const replace = require('gulp-replace');
const sass = require('gulp-sass');
// const stylelint = require('gulp-stylelint');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const webpack = require('webpack');
const gulpWebpack = require('webpack-stream');

/*
  Configuration variables.
*/

// Gather environment variables from .env file.
require('dotenv').config();

// Determine if we're running in the dev environment. This is set by the script
// in `package.json` that calls this gulpfile so that we can force the script to
// generate production-ready files.
const isDev = process.env.NODE_ENV === 'development';

// Paths.
const srcDir = './_src';
const themeDir = '.';
const assetsDir = themeDir + '/assets';
const paths = {
  js: {
    srcDir: srcDir + '/js/',
    src: srcDir + '/js/**/*.js',
    dest: assetsDir + '/js'
  },
  css: {
    src: srcDir + '/css/**/*.{sass,scss,css}',
    dest: assetsDir + '/css'
  },
  images: {
    src: srcDir + '/images/**/*',
    dest: assetsDir + '/images'
  },
  templates: themeDir + '/**/*.php',
  functionsFile: themeDir + '/functions.php'
};

// Export to allow other scripts (i.e. Webpack) to access these paths.
exports.paths = paths;


/*
  Task configuration.
*/

// Build JS.
const webpackConfig = require('./webpack.' + process.env.NODE_ENV + '.js');
const compileJS = () => {
  return gulp.src(paths.js.src)
    .pipe(gulpWebpack(webpackConfig, webpack))
    .pipe(gulp.dest(paths.js.dest))
}

// Build Modernizr file.
const compileModernizr = () => {
  return gulp.src([paths.js.src, paths.css.src])
    .pipe(modernizr({
      excludeTests: [
        'svg'
      ]
    }))
    .pipe(uglify())
    .pipe(gulp.dest(paths.js.dest))
}

// Build CSS.
const compileCSS = () => {
  const sassOptions = {
    includePaths: ['node_modules']
  }

  // const stylelintOptions = {
  //   reporters: [
  //     {
  //       formatter: 'string',
  //       console: true
  //     }
  //   ]
  // }

  return gulp.src(paths.css.src)
    // .pipe(stylelint(stylelintOptions))
    .pipe(gulpif(isDev, sourcemaps.init()))
    .pipe(sass(sassOptions))
    .on('error', notify.onError((error) => {
      return error.message;
    }))
    .pipe(postcss([ autoprefixer() ]))
    .pipe(cleanCSS())
    .pipe(gulpif(isDev, sourcemaps.write()))
    .pipe(gulp.dest(paths.css.dest))
}

// Images.
const optimizeImages = () => {
  return gulp.src(paths.images.src)
    .pipe(cache(
      imagemin([
        imagemin.gifsicle({interlaced: true}),
        imagemin.mozjpeg({progressive: true}),
        imagemin.optipng({optimizationLevel: 5}),
        imagemin.svgo({
          plugins: [
            {removeViewBox: false},
            {cleanupIDs: false}
          ]
        })
      ])
    ))
    .pipe(gulp.dest(paths.images.dest))
}

// Watch for changes.
const watch = () => {
  // CSS: Watch for source files to change, recompile CSS, and reload.
  gulp.watch(paths.css.src, compileCSS);

  // Images: Watch for images to change, re-optimize them, and reload.
  gulp.watch(paths.images.src, optimizeImages);
}

// Clean up.
const clean = () => {
  return del([
    paths.images.dest,
  ])
}

// Update the timestamp used for cache-busting.
const bustCache = () => {
  return gulp.src(paths.functionsFile)
    .pipe(
      replace(/'CACHEBUST', '\d+'/g, function() {
        return "'CACHEBUST', '" + new Date().getTime() + "'";
      })
    )
    .pipe(gulp.dest(themeDir));
}

// Build assets.
const compileAssets = gulp.parallel(
  compileCSS,
  compileJS,
  compileModernizr,
  optimizeImages
);

/*
  Exports.
*/

// Define tasks.
exports.dev = gulp.series(clean, gulp.parallel(compileAssets, watch));
exports.build = gulp.series(clean, compileAssets, bustCache);
exports.dist = gulp.series(clean, compileAssets, bustCache);
