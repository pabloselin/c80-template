var gulp = require( 'gulp' );
var less = require( 'gulp-less' );
var plumber = require( 'gulp-plumber' );
var notify = require( 'gulp-notify' );
var minify = require( 'gulp-minify' );
var concat = require( 'gulp-concat' );

var plumberErrorHandler = { errorHandler: notify.onError({
    
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
  
  })
};

gulp.task('default', ['less', 'embeds', 'scripts', 'compress']);

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

gulp.task('scripts', function() {
	return gulp.src(['./assets/js/src/bootstrap.js', './assets/js/src/scripts.js'])
			.pipe(concat('c80.js'))
			.pipe(gulp.dest('./assets/js/'));
});

gulp.task('compress', function() {
	gulp.src('./assets/js/c80.js')
		.pipe(minify({
			ext: {
				min: '.min.js'
			}
		}))
		.pipe(gulp.dest('./assets/js/'));
});

gulp.task('watch', function() {
	gulp.watch(['assets/css/src/**/*.less', 'assets/js/*.js'], ['less', 'embeds', 'scripts']);
});

