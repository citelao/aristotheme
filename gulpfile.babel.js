/* eslint-env node */
import gulp from 'gulp';
import os from 'os';

import imageResize from 'gulp-image-resize';
import imagemin from 'gulp-imagemin';
import notify from 'gulp-notify';
import parallel from 'concurrent-transform';
import sass from 'gulp-sass';

gulp.task('default', ['build']);

gulp.task('serve', ['css', 'php', 'img', 'lib'], () => {
  gulp.watch('src/sass/**/*.scss', ['css']);
  gulp.watch('src/**/*.php', ['php']);
  gulp.watch('src/img/**/*.{jpg,jpeg,png}', ['img']);
  gulp.watch('lib/**/*', ['lib']);
});

gulp.task('build', ['css', 'php', 'img', 'lib']);

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

gulp.task('img', () => {
  return gulp.src(['src/img/**/*.{jpg,jpeg,png}'])
    .pipe(notify('Compiling images...'))
    .pipe(parallel(imageResize({
        width: 1170 * 1.5 // max-width of bootstrap grid * 1.5 for semiretina
      })),
      os.cpus().length
    )
    .pipe(imagemin({
        progressive: true,
        interlaced: true,
        svgoPlugins: [{removeViewBox: false}]
    }))
    .on('error', function (err) {
      console.log(err);
      this.end();
    })
    .pipe(gulp.dest('dist/img'))
    .pipe(notify('Compiled images.'));
});

gulp.task('lib', () => {
  return gulp.src(['lib/**/*'])
    .pipe(gulp.dest('dist/'))
    .pipe(notify('Compiled libs.'));
});
