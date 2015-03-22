module.exports = function(grunt) {

	require('load-grunt-tasks')(grunt);
	require('time-grunt')(grunt);

	grunt.initConfig({

		htmlmin: {
			html: {
				options: {
					removeComments: true,
					collapseWhitespace: true
				},
				expand: true,
				cwd: 'out/',
				src: '**/index.html',
				dest: 'out/'
			},
			xml: {
				options: {
					collapseWhitespace: true,
					keepClosingSlash: true
				},
				expand: true,
				cwd: 'out/',
				src: 'feed/**/*.xml',
				dest: 'out/'
			}
		},

		beml: {
			options: {
				elemPrefix: '__',
				modPrefix: '--'
			},
			files: {
				expand: true,
				cwd: 'out/',
				src: '**/index.html',
				dest: 'out/'
			}
		},

		concat: {
			task: {
				src: [
					'src/static/scripts/webfont.js',
					'src/static/scripts/webfont-config.js'
				],
				dest: 'out/scripts/script.js'
			}
		},

		uglify: {
			task: {
                src: 'out/scripts/script.js',
                dest: 'out/scripts/script.js'
			}
		},

		sass: {
			task: {
				files: {
					'out/styles/screen.css': 'src/static/styles/screen.scss'
				}
			}
		},

		autoprefixer: {
			task: {
				src: 'out/styles/screen.css'
			}
		},

		cssmin: {
			task: {
				files: {
					'out/styles/screen.css': 'out/styles/screen.css'
				}
			}
		},

		connect: {
			task: {
				options: {
					base: 'out',
					livereload: true,
					open: true
				}
			}
		},

		watch: {
			html: {
				files: 'src/**/*.{md,eco}',
				tasks: 'html'
			},
			styles: {
				files: 'src/static/styles/*.scss',
				tasks: 'styles'
			},
			livereload: {
				options: {
					livereload: true
				},
				files: 'out/**/*.{html,css}'
			}
		},

		shell: {
			docpad: {
				command: 'docpad generate --env static'
			}
		}

	});

	grunt.registerTask('html', [
		'shell',
		'htmlmin',
		'beml'
	]);

	grunt.registerTask('styles', [
		'sass',
		'autoprefixer',
		'cssmin'
	]);

	grunt.registerTask('scripts', [
		'concat',
		'uglify'
	]);

	grunt.registerTask('build', [
		'html',
		'styles',
		'scripts'
	]);

	grunt.registerTask('default', [
		'build',
		'connect',
		'watch'
	]);

};
