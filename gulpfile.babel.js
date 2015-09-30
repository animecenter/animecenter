import gulp from 'gulp';
import gulpLoadPlugins from 'gulp-load-plugins';
import browserSync from 'browser-sync';
import del from 'del';
import {stream as wiredep} from 'wiredep';

const $ = gulpLoadPlugins();
const reload = browserSync.reload;
var mainBowerFiles = require('main-bower-files');
var exec = require('child_process').exec;

// Minify, and autoprefix css. Copy them to the css directory.
gulp.task('css', () => {
    return gulp.src('resources/assets/sass/*.scss')
        .pipe($.plumber())
        .pipe($.sourcemaps.init())
        .pipe($.sass.sync({
            outputStyle: 'compressed',
            precision: 10,
            includePaths: [
                'components/bootstrap-sass-official/assets/stylesheets',
                'components/font-awesome/scss'
            ]
        }).on('error', $.sass.logError))
        .pipe($.autoprefixer({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']}))
        .pipe($.sourcemaps.write())
        .pipe(gulp.dest('public/css'))
        .pipe($.size())
        .pipe(reload({stream: true}));
});

// Get components fonts and copy them to the fonts directory.
gulp.task('fonts', () => {
    return gulp.src(mainBowerFiles('**/*.{eot,svg,ttf,woff,woff2}'))
        .pipe(gulp.dest('public/fonts'))
        .pipe($.size());
});

// Minify images and copy them to the images directory.
gulp.task('images', () => {
    return gulp.src('resources/assets/img/**/*')
        .pipe($.if($.if.isFile, $.cache($.imagemin({
            progressive: true,
            interlaced: true,
            // don't remove IDs from SVGs, they are often used
            // as hooks for embedding and styling
            svgoPlugins: [{cleanupIDs: false}]
        }))
            .on('error', (err) => {
                console.log(err);
                this.end();
            })))
        .pipe(gulp.dest('public/img'))
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
        mocha: true
    }
};

gulp.task('lint', lint(['resources/assets/js/**/*.js', '!resources/assets/js/vendor/**/*']));
gulp.task('lint:test', lint('tests/spec/**/*.js', testLintOptions));

// Copy components javascript files to vendor folder.
gulp.task('vendor', () => {
    return gulp.src(mainBowerFiles({checkExistence: true, filter: ['**/*.js']}))
        .pipe(gulp.dest('resources/assets/js/vendor'))
        .pipe($.size());
});

// Concatenate together all js from vendor into one minify file for the application.
gulp.task('concat', ['vendor'], () => {
    return gulp.src([
        'resources/assets/js/vendor/jquery.js',
        'resources/assets/js/vendor/bootstrap.js',
        'resources/assets/js/vendor/**/*.js',
        'resources/assets/js/**/*.js'
    ])
        .pipe($.concat('app.js'))
        .pipe($.uglify())
        .on('error', (err) => {
            console.log(err);
            this.end();
        })
        .pipe(gulp.dest('public/js'))
        .pipe($.size());
});

gulp.task('js', ['concat']);

gulp.task('serve', ['build'], () => {
    browserSync({
        options: {
            proxy: 'localhost:80'
        }
    });

    gulp.watch([
        'public/css/*.css',
        'public/fonts/**/*',
        'public/img/**/*',
        'public/js/*.js',
        'resources/views/**/*.php'
    ]).on('change', reload);

    gulp.watch('resources/assets/sass/**/*.scss', ['css']);
    gulp.watch('resources/assets/js/**/*.js', ['js']);
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
                '/components': 'components'
            }
        }
    });

    gulp.watch('tests/spec/**/*.js').on('change', reload);
    gulp.watch('tests/spec/**/*.js', ['lint:test']);
});

// Watch for any changes and reload the browser
gulp.task('watch', ['serve']);

// Runs all commands to build the application and returns the size of all assets except for the upload folder.
gulp.task('build', ['css', 'fonts', 'images', 'js'], () => {
    return gulp.src(['public/**/*', '!public/uploads']).pipe($.size({title: 'build', gzip: true}));
});

// Default command for gulp. Runs the build command.
gulp.task('default', ['build']);