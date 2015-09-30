import gulp from 'gulp';
import gulpLoadPlugins from 'gulp-load-plugins';
import browserSync from 'browser-sync';
import del from 'del';
import {stream as wiredep} from 'wiredep';

const $ = gulpLoadPlugins();
const reload = browserSync.reload;
var mainBowerFiles = require('main-bower-files');

gulp.task('css', () => {
    return gulp.src('resources/assets/sass/*.scss')
        .pipe($.plumber())
        .pipe($.sourcemaps.init())
        .pipe($.sass.sync({
            outputStyle: 'expanded',
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

function lint(files, options) {
    return () => {
        return gulp.src(files)
            .pipe(reload({stream: true, once: true}))
            .pipe($.eslint(options))
            .pipe($.eslint.format())
            .pipe($.if(!browserSync.active, $.eslint.failAfterError()))
            .pipe(gulp.dest('public/js'));
    };
}
const testLintOptions = {
    env: {
        mocha: true
    }
};

gulp.task('lint', lint([
    'resources/assets/vendor/jquery.js',
    'resources/assets/vendor/bootstrap.js',
    'resources/assets/vendor/**/*.js',
    'resources/assets/js/**/*.js'
]));
gulp.task('lint:test', lint('tests/spec/**/*.js', testLintOptions));

gulp.task('images', () => {
    return gulp.src('resources/assets/img/**/*')
        .pipe($.if($.if.isFile, $.cache($.imagemin({
            progressive: true,
            interlaced: true,
            // don't remove IDs from SVGs, they are often used
            // as hooks for embedding and styling
            svgoPlugins: [{cleanupIDs: false}]
        }))
            .on('error', function (err) {
                console.log(err);
                this.end();
            })))
        .pipe(gulp.dest('public/img'));
});

gulp.task('fonts', () => {
    return gulp.src(mainBowerFiles('**/*.{eot,svg,ttf,woff,woff2}'))
        .pipe(gulp.dest('public/fonts'))
        .pipe($.size());
});

gulp.task('clean', del.bind(null, ['dist']));

gulp.task('serve', ['css', 'fonts'], () => {
    browserSync({
        notify: false,
        port: 9000,
        server: {
            baseDir: ['public'],
            routes: {
                '/components': 'components'
            }
        }
    });

    gulp.watch([
        'resources/views/**/*.php',
        'public/js/*.js',
        'public/css/*.css',
        'public/img/**/*',
        'public/fonts/**/*'
    ]).on('change', reload);

    gulp.watch('resources/assets/sass/**/*.scss', ['css']);
    gulp.watch('resources/assets/js/**/*.js', ['lint']);
    gulp.watch('bower.json', ['wiredep', 'fonts']);
});

gulp.task('serve:dist', () => {
    browserSync({
        notify: false,
        port: 9000,
        server: {
            baseDir: ['dist']
        }
    });
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

// inject bower components
gulp.task('wiredep', () => {
    gulp.src('resources/assets/sass/*.scss')
    .pipe(wiredep({
        ignorePath: /^(\.\.\/)+/
    }))
    .pipe(gulp.dest('public/css'));
    gulp.src('app/*.html')
        .pipe(wiredep({
            exclude: ['bootstrap-sass'],
            ignorePath: /^(\.\.\/)*\.\./
        }))
    .pipe(gulp.dest('public/'));
});

gulp.task('build', ['css', 'fonts', 'js', 'images'], () => {
    return gulp.src('public/**/*').pipe($.size({title: 'build', gzip: true}));
});

gulp.task('default', ['clean'], () => {
    gulp.start('build');
});