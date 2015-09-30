// jshint node:true
'use strict';

var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var mainBowerFiles = require('main-bower-files');

// Folders Path Config
var pathTo = {
 public: 'public/country',
 sass: 'resources/assets/sass',
 components: 'components',
 css: '/css',
 js: '/js',
 img: '/img',
 php: 'resources/views',
 fonts: '/fonts',
 assets: 'resources/assets'
}

// Copy all require components js to vendor folder
gulp.task('vendor', function () {
 return gulp.src(mainBowerFiles({ checkExistence: true }))
     .pipe($.filter(['**/**.js', '!bootstrap.js']))
     .pipe(gulp.dest(pathTo.assets + '/vendor'));
});

// Joins together all js from vendor into one minify file for the application
gulp.task('concat', ['vendor'], function () {
 return gulp.src([
  pathTo.assets + '/vendor/jquery.js',
  pathTo.assets + '/vendor/bootstrap.js',
  pathTo.assets + '/vendor/**/*.js',
  pathTo.assets + '/js/**/*.js'
 ])
     .pipe($.concat('main.js'))
     .pipe($.uglify())
     .pipe(gulp.dest(pathTo.public + pathTo.js))
     .pipe($.size())
     .on('error', $.notify.onError(function (error) {
      return 'Error: ' + error.message;
     }));
});

// Checks js files for errors excluding minify vendor file
gulp.task('jshint', ['concat'], function () {
 var filterVendor = $.filter(['!vendor.min.js']);
 return gulp.src(pathTo.public + pathTo.js + '/*.js')
     .pipe(filterVendor)
     .pipe($.jshint())
     .pipe($.jshint.reporter('jshint-stylish'))
});

gulp.task('js', ['jshint']);

// Copy all fonts to the application fonts folder
gulp.task('fonts', function () {
 return gulp.src(mainBowerFiles({filter: '**/*.{eot,svg,ttf,woff,woff2}'}))
     .pipe(gulp.dest(pathTo.public + pathTo.fonts))
     .pipe($.size());
});

// Watch for any changes on any file and reloads the browser
gulp.task('serve', function () {
 browserSync({
  options: {
   proxy: 'localhost:80'
  }
 });

 // watch for changes
 gulp.watch([
  pathTo.public + pathTo.js + '/**/*.js',
  pathTo.public + pathTo.css + '/**/*.css',
  pathTo.public + pathTo.img + '/**/*',
  pathTo.public + pathTo.php + '/**/*.php',
  pathTo.public + pathTo.fonts + '/**/*',
 ]).on('change', reload);

});

// Watch for any changes on SCSS files to convert to css
gulp.task('watch', ['serve'], function () {
 gulp.watch(pathTo.sass + '/**/*.scss', ['css']);
});

// Command for building the application
gulp.task('build', ['css', 'js', 'img', 'fonts'], function () {
 return gulp.src('**/*').pipe($.size({title: 'build', gzip: true}));
});

// Default command gulp. Run all commands and starts the server to watch for files changes and autoreload the browser.
gulp.task('default', ['build'], function () {
 gulp.start('watch');
});