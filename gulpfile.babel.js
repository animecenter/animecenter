import gulp from 'gulp';
import gulpLoadPlugins from 'gulp-load-plugins';
import browserSync from 'browser-sync';
import fs from 'fs';
import path from 'path';

const $ = gulpLoadPlugins();
const reload = browserSync.reload;
const mainBowerFiles = require('main-bower-files');
const dir = {
  public: 'public',
  assets: 'resources/assets',
  tests: 'tests',
  components: 'components',
};
const pathTo = {
  public: {
    css: dir.public + '/css',
    fonts: dir.public + '/fonts',
    img: dir.public + '/img',
    js: dir.public + '/js',
    uploads: dir.public + '/uploads',
  },
  assets: {
    img: dir.assets + '/img',
    js: dir.assets + '/js',
    php: dir.assets + '/views',
    sass: dir.assets + '/sass',
  },
};

function getFolders(directory) {
  return fs.readdirSync(directory).filter(function(file) {
    return fs.statSync(path.join(directory, file)).isDirectory();
  });
}

// Add vendor prefixes to CSS and minify it. Move minify file to the css directory.
gulp.task('css', () => {
  const folders = getFolders(pathTo.assets.sass);

  folders.map(function(folder) {
    return gulp.src(path.join(pathTo.assets.sass, folder, '*.scss'))
      .pipe($.plumber())
      .pipe($.sourcemaps.init())
      .pipe($.sass.sync({
        outputStyle: 'compressed',
        precision: 10,
        includePaths: [
          dir.components + '/bootstrap-sass-official/assets/stylesheets',
          dir.components + '/font-awesome/scss',
        ],
      }).on('error', $.sass.logError))
      .pipe($.autoprefixer({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']}))
      .pipe($.sourcemaps.write())
      .pipe(gulp.dest(pathTo.public.css))
      .pipe($.size())
      .pipe(reload({stream: true})
    );
  });
});

// Copy components fonts files to the fonts directory.
gulp.task('fonts', () => {
  return gulp.src(mainBowerFiles('**/*.{eot,svg,ttf,woff,woff2}'))
    .pipe(gulp.dest(pathTo.public.fonts))
    .pipe($.size());
});

// Minify images and move the resulting files to the images directory.
gulp.task('img', () => {
  return gulp.src(pathTo.assets.img + '/**/*')
    .pipe($.if($.if.isFile, $.cache($.imagemin({
      progressive: true,
      interlaced: true,
      // don't remove IDs from SVGs, they are often used
      // as hooks for embedding and styling
      svgoPlugins: [{cleanupIDs: false}],
    })).on('error', (err) => {
      console.log(err);
      this.end();
    })))
    .pipe(gulp.dest(pathTo.public.img))
    .pipe($.size());
});

function lint(files, options) {
  return () => {
    return gulp.src(files)
      .pipe(reload({stream: true, once: true}))
      .pipe($.eslint(options))
      .pipe($.eslint.format())
      .pipe($.if(!browserSync.active, $.eslint.failAfterError()));
  };
}

const testLintOptions = {
  env: {
    mocha: true,
  },
};

gulp.task('lint', lint([pathTo.assets.js + '/**/*.js', '!' + pathTo.assets.js + '/vendor/**/*']));
gulp.task('lint:test', lint(pathTo.tests + '/spec/**/*.js', testLintOptions));

// Copy components javascript files to vendor folder.
gulp.task('vendor', () => {
  return gulp.src(mainBowerFiles({checkExistence: true, filter: ['**/*.js']}))
    .pipe(gulp.dest(pathTo.assets.js + '/app/vendor'))
    .pipe($.size());
});

// Concatenate together all js from vendor into one minify file for the application.
gulp.task('concat', ['vendor'], () => {
  const folders = getFolders(pathTo.assets.js);
  folders.map(function(folder) {
    return gulp.src([
      path.join(pathTo.assets.js, folder, 'vendor/jquery.js'),
      path.join(pathTo.assets.js, folder, 'vendor/bootstrap.js'),
      path.join(pathTo.assets.js, folder, 'vendor/**/*.js'),
      path.join(pathTo.assets.js, folder, '**/*.js'),
    ])
      .pipe($.concat(folder + '.js'))
      .pipe($.uglify()).on('error', (err) => {
        console.log(err);
        this.end();
      })
      .pipe(gulp.dest(pathTo.public.js))
      .pipe($.size());
  });
});

gulp.task('js', ['concat']);

gulp.task('serve', ['build'], () => {
  browserSync({
    options: {
      proxy: 'localhost:80',
    },
  });
  gulp.watch([
    pathTo.public.css + '/*.css',
    pathTo.public.fonts + '/**/*',
    pathTo.public.img + '/**/*',
    pathTo.public.js + '/*.js',
    pathTo.assets.php + '/**/*.php',
  ]).on('change', reload);
  gulp.watch(pathTo.assets.sass + '/**/*.scss', ['css']);
  gulp.watch(pathTo.assets.js + '/**/*.js', ['js']);
  gulp.watch('bower.json', ['bower:install']);
});

gulp.task('serve:test', () => {
  browserSync({
    notify: false,
    port: 9000,
    ui: false,
    server: {
      baseDir: 'tests',
      routes: {
        '/components': 'components',
      },
    },
  });
  gulp.watch(pathTo.tests + '/spec/**/*.js').on('change', reload);
  gulp.watch(pathTo.tests + '/spec/**/*.js', ['lint:test']);
});

// Watch for any changes and reload the browser
gulp.task('watch', ['serve']);

// Runs all commands to build the application and returns the size of all assets except for the upload folder.
gulp.task('build', ['css', 'fonts', 'img', 'js'], () => {
  return gulp.src([dir.public + '/**/*', '!' + pathTo.public.uploads])
      .pipe($.size({title: 'build', gzip: true}));
});

// Default command for gulp. Runs the build command.
gulp.task('default', ['build']);
