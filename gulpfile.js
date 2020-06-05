var gulp = require( 'gulp' );
var less = require( 'gulp-less' );
var plumber = require( 'gulp-plumber' );
var notify = require( 'gulp-notify' );
var minify = require( 'gulp-minify' );
var concat = require( 'gulp-concat' );
var browserSync = require('browser-sync').create();

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
		.pipe(gulp.dest('assets/css'))
		.pipe(browserSync.stream());	
});

gulp.task('embeds', function() {
	return gulp.src('assets/css/src/c80-embeds.less')
		.pipe(plumber(plumberErrorHandler))
		.pipe(less())
		.pipe(gulp.dest('assets/css'));
});

gulp.task('scripts', function() {
	return gulp.src(['./assets/js/src/bootstrap.js', './assets/js/src/scripts.js', './assets/js/src/timeline.js'])
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

gulp.task('browser-sync', function() {
	browserSync.init({
		proxy: "c80.local"
	});
});

gulp.task('watch', function() {
	
	browserSync.init({
		proxy: "c80.local"
	});

	gulp.watch(['assets/css/src/**/*.less', 'assets/js/src/*.js'], ['less', 'embeds', 'scripts']);
	gulp.watch(['assets/css/*.css', 'assets/js/**/*.js', '**/*.php']).on('change', browserSync.reload);
});


