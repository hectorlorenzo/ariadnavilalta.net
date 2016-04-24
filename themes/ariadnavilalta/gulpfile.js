/*!
 * gulp
 * $ npm install gulp-ruby-sass gulp-autoprefixer gulp-minify-css gulp-jshint gulp-concat gulp-uglify gulp-imagemin gulp-notify gulp-rename gulp-livereload gulp-cache del --save-dev
 */

// Load plugins
var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    livereload = require('gulp-livereload'),
    del = require('del');

// Styles
gulp.task('styles', function() {
  return gulp.src('assets/source/css/main.scss')
    .pipe(sass({ style: 'expanded', }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    .pipe(gulp.dest('assets/build/css'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(minifycss())
    .pipe(gulp.dest('assets/build/css'))
    .pipe(notify({ message: 'Styles task complete' }));
});

// Scripts
gulp.task('scripts', function() {
  return gulp.src([
      'assets/source/js/libs/swipe.js',
      'assets/source/js/libs/picturefill.js',
      'assets/source/js/libs/imagesloaded.pkgd.min.js',
      'assets/source/js/libs/masonry.js',
      'assets/source/js/main.js'
    ])
    .pipe(concat('main.js'))
    .pipe(gulp.dest('assets/build/js/'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('assets/build/js/'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Clean
gulp.task('clean', function(cb) {
    del(['assets/build/css', 'assets/build/js'], cb)
});

// Default task
gulp.task('default', ['clean'], function() {
    gulp.start('styles', 'scripts');
});

// Watch
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch('assets/source/css/**/*.scss', ['styles']);

  // Watch .js files
  gulp.watch('assets/source/js/**/*.js', ['scripts']);

});
