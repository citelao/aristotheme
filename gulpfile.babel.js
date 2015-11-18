/* eslint-env node */
import gulp from 'gulp';
import os from 'os';

import importCss from 'gulp-import-css';
import imageResize from 'gulp-image-resize';
import imagemin from 'gulp-imagemin';
import notify from 'gulp-notify';
import parallel from 'concurrent-transform';
import plumber from 'gulp-plumber';
import sass from 'gulp-sass';

gulp.task('default', ['build']);

gulp.task('serve', ['css', 'php', 'img', 'otherimage', 'lib'], () => {
  gulp.watch('src/sass/**/*.scss', ['css']);
  gulp.watch('src/**/*.php', ['php']);
  gulp.watch('src/img/**/*.{jpg,jpeg,png}', ['img']);
  gulp.watch('src/img/**/*.{svg, gif}', ['otherimage']);
  gulp.watch(['lib/**/*', 'bower_components/**/*'], ['lib']);
});

gulp.task('build', ['css', 'php', 'img', 'otherimage', 'lib']);

gulp.task('css', () => {
  return gulp.src('src/sass/**/*.scss')
    .pipe(notify({
      'onLast': true,
      'message': 'Compiling SCSS...',
      'title': 'Build Status'
    }))
    .pipe(plumber({ errorHandler: notify.onError('Error compiling SCSS!') }))
    .pipe(sass({
      'precision': 9
    }))
    .pipe(importCss())
    .pipe(gulp.dest('./dist'))
    .pipe(notify({
      'onLast': true,
      'message': 'Compiled SCSS.',
      'title': 'Build Status'
    }));
});

gulp.task('php', () => {
  return gulp.src(['src/**/*.php'])
    .pipe(gulp.dest('dist/'))
    .pipe(notify({
      'onLast': true,
      'message': 'Compiled PHP.',
      'title': 'Build Status'
    }));
});

gulp.task('img', () => {
  return gulp.src(['src/img/**/*.{jpg,jpeg,png}'])
    .pipe(notify({
      'onLast': true,
      'message': 'Compiling images...',
      'title': 'Build Status'
    }))
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
    .pipe(notify({
      'onLast': true,
      'message': 'Compiled images.',
      'title': 'Build Status'
    }));
});

gulp.task('otherimage', () => {
  return gulp.src(['src/img/**/*.{svg,gif}'])
    .pipe(gulp.dest('dist/img'))
    .pipe(notify({
      'onLast': true,
      'message': 'Compiled vectors.',
      'title': 'Build Status'
    }));
});

gulp.task('lib', () => {
  return gulp.src(['lib/**/*'])
    .pipe(gulp.dest('dist/'))
    .pipe(notify({
      'onLast': true,
      'message': 'Compiled libs.',
      'title': 'Build Status'
    }));
});
