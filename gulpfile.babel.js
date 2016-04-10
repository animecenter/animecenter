import gulp from 'gulp';
import gulpLoadPlugins from 'gulp-load-plugins';
import browserSync from 'browser-sync';

const plugins = gulpLoadPlugins();
const reload = browserSync.reload;
const mainBowerFiles = require('main-bower-files');

// Add vendor prefixes to CSS and minify it. Move minify file to the css directory.
gulp.task('css', () => {
  ['resources/assets/app', 'resources/assets/dashboard'].map((folder) =>
    gulp.src(`${folder}/scss/**/*.scss`)
      .pipe(plugins.plumber())
      .pipe(plugins.sourcemaps.init())
      .pipe(plugins.sass.sync({
        outputStyle: 'compressed',
        precision: 10,
        includePaths: [
          'bower_components/',
        ],
      }).on('error', plugins.sass.logError))
      .pipe(plugins.autoprefixer({ browsers: ['> 1%', 'last 2 versions', 'Firefox ESR'] }))
      .pipe(plugins.sourcemaps.write('.'))
      .pipe(gulp.dest('public/css'))
  );
});

// Copy components fonts files to the fonts directory.
gulp.task('fonts', () =>
  gulp.src(mainBowerFiles('**/*.{eot,svg,ttf,woff,woff2}')).pipe(gulp.dest('public/fonts'))
);

// Minify images and move the resulting files to the images directory.
gulp.task('img', () =>
  gulp.src('resources/assets/{app,dashboard}/img/**/*')
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

// Copy components javascript files to vendor folder.
gulp.task('vendor', () =>
  gulp.src(mainBowerFiles({ checkExistence: true, filter: ['**/*.js'] }))
    .pipe(gulp.dest('resources/assets/app/js/vendor'))
    .pipe(plugins.size())
);

// Concatenate together all js from vendor into one minify file for the application.
gulp.task('concat', ['vendor'], () => {
  const apps = [
    {
      name: 'app',
      assets: [
        'resources/assets/app/js/vendor/tether.js',
        'resources/assets/app/js/vendor/jquery.js',
        'resources/assets/app/js/vendor/bootstrap.js',
        'resources/assets/app/js/app.js',
      ],
    },
    {
      name: 'dashboard',
      assets: [
        'resources/assets/dashboard/js/vendor/jquery.js',
        'resources/assets/dashboard/js/vendor/bootstrap.js',
        'resources/assets/dashboard/js/vendor/jquery.dataTables.js',
        'resources/assets/dashboard/js/vendor/dataTables.bootstrap.js',
        'resources/assets/dashboard/js/vendor/jquery.slimscroll.js',
        'resources/assets/dashboard/js/vendor/fastclick.js',
        'resources/assets/dashboard/js/vendor/admin-lte.js',
        'resources/assets/dashboard/js/dashboard.js',
      ],
    },
  ];
  apps.map((app) =>
    gulp.src(app.assets)
      .pipe(plugins.plumber())
      .pipe(plugins.sourcemaps.init())
      // .pipe(plugins.babel())
      // .pipe(plugins.uglify()).on('error', (err) => {
      // console.log(err);
      // })
      .pipe(plugins.concat(`${app.name}.js`))
      .pipe(plugins.sourcemaps.write('.'))
      .pipe(gulp.dest('public/js'))
      .pipe(plugins.size())
  );
});

gulp.task('js', ['concat']);

gulp.task('serve', ['build'], () => {
  browserSync({
    options: {
      proxy: 'localhost:80',
    },
  });

  gulp.watch('resources/assets/{app,dashboard}/scss/**/*.scss', ['css']);
  gulp.watch('resources/assets/{app,dashboard}/js/**/*.js', ['js']);
  gulp.watch('bower.json', ['bower:install']);

  gulp.watch([
    'public/css/*.css',
    'public/fonts/**/*',
    'public/img/**/*',
    'public/js/**/*.js',
    'resources/views/{app,dashboard}/**/*.php',
  ]).on('change', reload);
});

// Watch for any changes and reload the browser
gulp.task('watch', ['serve']);

// Runs all commands to build the application.
// Returns the size of all assets except for the upload folder.
gulp.task('build', ['css', 'fonts', 'img', 'js'], () =>
  gulp.src(['public/**/*', '!public/uploads']).pipe(plugins.size({ title: 'build', gzip: true }))
);

// Default command for gulp. Runs the build command.
gulp.task('default', ['build']);
