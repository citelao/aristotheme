/* eslint-env node */
import gulp from 'gulp';

import composer from 'gulp-composer';
import notify from 'gulp-notify';
import sass from 'gulp-sass';
import rename from 'gulp-rename';
import run from 'gulp-run';

gulp.task('default', ['init', 'build']);

gulp.task('serve', ['css', 'php'], () => {
  gulp.watch('src/sass/**/*.scss', ['css']);
  gulp.watch(['src/**/*.php', 'src/**/*.haml'], ['php']);
});

gulp.task('init', () => {
  composer({ cwd: process.cwd().replace(' ', '\\ ') });
});

gulp.task('build', ['css', 'php']);

gulp.task('css', () => {
  return gulp.src('src/sass/**/*.scss')
    .pipe(notify('Compiling SCSS...'))
    .pipe(sass())
    .pipe(gulp.dest('./dist'))
    .pipe(notify('Compiled SCSS.'));
});

gulp.task('php', ['haml'], () => {
  return gulp.src(['src/**/*.php', '.tmp/php/**/*.php'])
    .pipe(gulp.dest('dist/'))
    .pipe(notify('Compiled PHP.'));
});

gulp.task('haml', () => {
  return gulp.src('src/**/*.haml', { 'read': false })
    .pipe(run("php build/haml.php <%= file.path.replace(' ', '\\\\ ') %> ", { verbosity: 1 }))
    .pipe(rename({
      extname: '.php'
    }))
    .pipe(gulp.dest('.tmp/php'))
    .pipe(notify('Compiled HAML.'));
});
