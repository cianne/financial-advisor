var gulp = require('gulp'),
    compass = require('gulp-compass'),
    autoprefixer = require('gulp-autoprefixer'),
    //minifycss = require('gulp-minify-css'),
    // csso = require('gulp-csso'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    // livereload = require('gulp-livereload'),
    del = require('del'),
    cleanCSS = require('gulp-clean-css');

// CSS
gulp.task('styles', function(){
    return gulp.src('assets/scss/style.scss')
        .pipe(compass({
            config_file: './config.rb',
            css: './',
            sass: 'assets/scss'
        }))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(gulp.dest('temp/css'))
        .pipe(rename('style.css'))
        //.pipe(minifycss()),
        .pipe(cleanCSS({compatibility: 'ie8'}))
        // .pipe(csso())
        .pipe(gulp.dest('./'))
        .pipe(notify({ message: 'Styles task complete' }));
} );

// JSHint
gulp.task('lint', function(){
    return gulp.src('assets/js/source/*.js')
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('default'))
});

// Scripts
gulp.task('source', function() {
    return gulp.src([
        'assets/js/source/*.js'
    ])
    .pipe(concat('app.js'))
    .pipe(gulp.dest('temp/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

gulp.task('vendor', function(){
    return gulp.src([
        // 'bower_components/modernizr/modernizr.js',
        // 'bower_components/velocity/velocity.js',
        // 'bower_components/velocity/velocity.ui.js',
        // 'bower_components/anijs/src/anijs.js',
        // 'bower_components/anijs/src/helpers/scrollreveal/anijs-helper-scrollreveal.js',
        // 'bower_components/anijs/src/helpers/dom/anijs-helper-dom.js',
        'bower_components/fitvids/jquery.fitvids.js',
        //'bower_components/packery/dist/packery.pkgd.min.js',
        //'bower_components/easytabs/lib/jquery.easytabs.js',
        'bower_components/owl-carousel/owl-carousel/owl.carousel.js',
        'bower_components/fancybox/source/jquery.fancybox.pack.js',
        'assets/js/vendor/*.js',
    ])
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest('temp/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Images
gulp.task('images', function() {
    return gulp.src('assets/images/**/*')
        .pipe(cache(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true })))
        .pipe(gulp.dest('images'))
        .pipe(notify({ message: 'Images task complete' }));
});

// Clean
gulp.task('clean', function(cb) {
    del(['temp/css', 'temp/js'], cb)
});

// Default task
gulp.task('default', ['clean'], function() {
    gulp.start('styles', 'lint', 'source', 'vendor', 'images', 'watch');
});

// Watch
gulp.task('watch', function() {
    // Watch .scss files
    gulp.watch(['assets/scss/*.scss', 'assets/scss/**/*.scss'], ['styles']);

    // Watch .js files
    gulp.watch(['assets/js/source/*.js'], ['source']);
    gulp.watch(['assets/js/vendor/*.js'], ['vendor']);
    
    // Watch image files
    gulp.watch('assets/images/**/*', ['images']);

});
