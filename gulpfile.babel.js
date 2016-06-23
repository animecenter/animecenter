import gulp from 'gulp';
import gulpLoadPlugins from 'gulp-load-plugins';
import browserSync from 'browser-sync';

const plugins = gulpLoadPlugins();
const reload = browserSync.reload;

// Minify images and move the resulting files to the images directory.
gulp.task('app:img', () =>
  gulp.src('resources/assets/app/img/**/*')
    .pipe(plugins.if(plugins.if.isFile, plugins.cache(plugins.imagemin({
      progressive: true,
      interlaced: true,
      // don't remove IDs from SVGs, they are often used
      // as hooks for embedding and styling
      svgoPlugins: [{ cleanupIDs: false }],
    })).on('error', (err) => {
      // noinspection Eslint
      console.log(err);
      this.end();
    })))
    .pipe(gulp.dest('public/img'))
    .pipe(plugins.size())
);

gulp.task('img', ['app:img']);

// Add vendor prefixes to CSS and minify it. Move minify file to the css directory.
gulp.task('app:css', () => {
  gulp.src('resources/assets/app/scss/**/*.scss')
    .pipe(plugins.plumber())
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.sass.sync({
      outputStyle: 'compressed',
      precision: 10,
      includePaths: [
        'node_modules/',
      ],
    }).on('error', plugins.sass.logError))
    .pipe(plugins.autoprefixer({ browsers: ['> 1%', 'last 2 versions', 'Firefox ESR'] }))
    .pipe(plugins.sourcemaps.write('.'))
    .pipe(gulp.dest('public/css'));
});

gulp.task('dashboard:css', () => {
  gulp.src('resources/assets/dashboard/scss/**/*.scss')
    .pipe(plugins.plumber())
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.sass.sync({
      outputStyle: 'compressed',
      precision: 10,
      includePaths: [
        'node_modules/',
      ],
    }).on('error', plugins.sass.logError))
    .pipe(plugins.autoprefixer({ browsers: ['> 1%', 'last 2 versions', 'Firefox ESR'] }))
    .pipe(plugins.sourcemaps.write('.'))
    .pipe(gulp.dest('public/css'));
});

gulp.task('css', ['app:css', 'dashboard:css']);

function lint(files, options) {
  return () => {
    gulp.src(files)
      .pipe(reload({ stream: true, once: true }))
      .pipe(plugins.eslint(options))
      .pipe(plugins.eslint.format())
      .pipe(plugins.if(!browserSync.active, plugins.eslint.failAfterError()));
  };
}

gulp.task('lint', lint([
  'resources/assets/{app,dashboard}/js/**/*.js',
  '!resources/assets/{app,dashboard}/js/vendor/**/*.js',
]));

// Concatenate together all js from vendor into one minify file for the application.
gulp.task('app:js', () => {
  gulp.src([
    'resources/assets/app/js/vendor/tether.js',
    'resources/assets/app/js/vendor/jquery.js',
    'resources/assets/app/js/vendor/bootstrap.js',
    'resources/assets/app/js/app.js',
  ])
    .pipe(plugins.plumber())
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.babel({ ignore: ['tether.js'] }))
    .pipe(plugins.uglify())
    .on('error', (err) => {
      console.log(err);
    })
    .pipe(plugins.concat('app.js'))
    .pipe(plugins.size())
    .pipe(plugins.sourcemaps.write('.'))
    .pipe(gulp.dest('public/js'));
});

gulp.task('dashboard:js', () => {
  gulp.src([
    'resources/assets/dashboard/js/vendor/jquery.js',
    'resources/assets/dashboard/js/vendor/bootstrap.js',
    'resources/assets/dashboard/js/vendor/jquery.dataTables.js',
    'resources/assets/dashboard/js/vendor/dataTables.bootstrap.js',
    'resources/assets/dashboard/js/vendor/jquery.slimscroll.js',
    'resources/assets/dashboard/js/vendor/fastclick.js',
    'resources/assets/dashboard/js/vendor/admin-lte.js',
    'resources/assets/dashboard/js/dashboard.js',
  ])
    .pipe(plugins.plumber())
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.uglify())
    .on('error', (err) => {
      console.log(err);
    })
    .pipe(plugins.concat('dashboard.js'))
    .pipe(plugins.size())
    .pipe(plugins.sourcemaps.write('.'))
    .pipe(gulp.dest('public/js'));
});

gulp.task('js', ['app:js', 'dashboard:js']);

gulp.task('watch', ['build'], () => {
  browserSync({
    options: {
      proxy: 'localhost:80',
    },
  });

  gulp.watch('resources/assets/app/scss/**/*.scss', ['app:css']);
  gulp.watch('resources/assets/dashboard/scss/**/*.scss', ['dashboard:css']);
  gulp.watch('resources/assets/app/js/**/*.js', ['app:js']);
  gulp.watch('resources/assets/dashboard/js/**/*.js', ['dashboard:js']);
  gulp.watch('resources/assets/app/img/**/*', ['app:img']);

  gulp.watch([
    'public/css/*.css',
    'public/fonts/**/*',
    'public/img/**/*',
    'public/js/**/*.js',
    'resources/views/{app,dashboard}/**/*.php',
  ]).on('change', reload);
});

// Runs all commands to build the application.
// Returns the size of all assets except for the upload folder.
gulp.task('build', ['css', 'fonts', 'img', 'js'], () =>
  gulp.src(['public/**/*', '!public/uploads']).pipe(plugins.size({ title: 'build', gzip: true }))
);

// Default command for gulp. Runs the build command.
gulp.task('default', ['build']);
