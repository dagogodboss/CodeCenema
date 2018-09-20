const gulp = require('gulp');
const livereload = require('gulp-livereload');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');

gulp.task('app-styles', function () {
  return gulp.src([
    'node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.css',
    'resources/assets/sass/font-awesome-4.7.0/font-awesome.scss',
    'resources/assets/sass/app.scss'
  ])
    .pipe(sass()['on']('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(concat('app.min.css'))
    .pipe(cleanCSS({level: {1: {specialComments: 0}}}))
    .pipe(gulp.dest('public/dist/css'))
    .pipe(livereload())
    ;
});

gulp.task('default', function () {
  livereload.listen();

  gulp.watch('resources/assets/sass/**/*.scss', ['app-styles']);
  gulp.watch('resources/views/**/*.blade.php', function () {
    livereload.reload();
  });

  // force run
  gulp.run(['app-styles']);
});