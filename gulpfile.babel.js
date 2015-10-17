/* eslint-env node */
import gulp from 'gulp';

import notify from 'gulp-notify';
import sass from 'gulp-sass';

gulp.task('default', ['build']);

gulp.task('serve', ['css', 'php', 'lib'], () => {
  gulp.watch('src/sass/**/*.scss', ['css']);
  gulp.watch('src/**/*.php', ['php']);
  gulp.watch('lib/**/*', ['lib']);
});

gulp.task('build', ['css', 'php', 'lib']);

gulp.task('css', () => {
  return gulp.src('src/sass/**/*.scss')
    .pipe(notify('Compiling SCSS...'))
    .pipe(sass())
    .pipe(gulp.dest('./dist'))
    .pipe(notify('Compiled SCSS.'));
});

gulp.task('php', () => {
  return gulp.src(['src/**/*.php'])
    .pipe(gulp.dest('dist/'))
    .pipe(notify('Compiled PHP.'));
});

gulp.task('lib', () => {
  return gulp.src(['lib/**/*'])
    .pipe(gulp.dest('dist/'))
    .pipe(notify('Compiled libs.'));
});