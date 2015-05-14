/**
 * Created by Jérémie on 22/04/2015.
 */

var paths ={
    css : './css',
    sass : './sass/'
};

// Require

var sass_include_path = [
    './bower_components/compass-mixins/lib/',
    './bower_components/susy/sass/',
    './bower_components/breakpoint-sass/stylesheets/'
];

var gulp = require('gulp');
var sass = require('gulp-sass');

// Tasks
gulp.task('sass', function () {
    gulp.src('./ressources/assets/sass/style.scss')
        .pipe(sass({
            includePaths: sass_include_path,
            errLogToConsole: true
        }))
        .pipe(gulp.dest('./ressources/assets/css/'));
});

gulp.task('watch-sass' , function(){
    gulp.start('sass');
    gulp.watch(paths.sass+"**/*", ['sass'])
});