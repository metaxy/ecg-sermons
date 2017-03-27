'use strict';

var path = require('path');
var ignore = require('gulp-ignore');
var gulp = require('gulp');
var less = require('gulp-less');
var rimraf = require('gulp-rimraf');

//TASKS
gulp.task('less',['clean'], function () {
  gulp.src(['!less/icons/**/*.less', 'less/**/*.less'])  
    .pipe(less({
      paths: ['less/']
    }).on('error', console.log))
    .pipe(gulp.dest("css"));
});


gulp.task('clean', function(cb){
  return gulp.src('css/**/*.css', { read: false }) // much faster
    .pipe(rimraf());
});


gulp.task('watch', ['less'], function() {
    gulp.watch('less/**/*.less', ['less']);
});