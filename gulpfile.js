const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const rename = require('gulp-rename');
const clean = require('gulp-clean');

gulp.task('clean', function () {
    // Clean the CSS dist folder
    return gulp.src('./Assets/CSS/dist/**/*', { read: false, allowEmpty: true })
        .pipe(clean());
});

gulp.task('sass', gulp.series('clean', function () {
    return gulp.src('./Assets/CSS/scss/**/*.scss')
        .pipe(rename(function (file) {
            // Remove underscores from the basename
            file.basename = file.basename.replace(/_/g, '');
        }))
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(gulp.dest('./Assets/CSS/dist/'));
}));

gulp.task('watch', function () {
    gulp.watch('./Assets/CSS/scss/*.scss', gulp.series('sass'));
});

gulp.task('default', gulp.series('sass', 'watch'));
