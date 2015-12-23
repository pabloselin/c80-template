var gulp = require( 'gulp' );
var less = require( 'gulp-less' );
var plumber = require( 'gulp-plumber' );
var notify = require( 'gulp-notify' );

var plumberErrorHandler = { errorHandler: notify.onError({
    
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
  
  })
};

gulp.task('default', ['less', 'watch']);

gulp.task('less', function() {
	return gulp.src('assets/css/src/main.less')
		.pipe(plumber(plumberErrorHandler))
		.pipe(less())
		.pipe(gulp.dest('assets/css'));	
});

gulp.task('embeds', function() {
	return gulp.src('assets/css/src/c80-embeds.less')
		.pipe(plumber(plumberErrorHandler))
		.pipe(less())
		.pipe(gulp.dest('assets/css'));
});



gulp.task('watch', function() {
	gulp.watch('assets/css/src/**/*.less', ['less', 'embeds']);
});

