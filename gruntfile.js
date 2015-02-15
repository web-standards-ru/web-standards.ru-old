module.exports = function(grunt) {

	require('load-grunt-tasks')(grunt);

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
			styles: {
				files: 'src/static/styles/*.scss',
				tasks: 'styles'
			},
			docpad: {
				files: 'src/**/*.{md,eco}',
				tasks: 'shell'
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

	grunt.registerTask('scripts', [
		'concat',
		'uglify'
	]);

	grunt.registerTask('styles', [
		'sass',
		'autoprefixer',
		'cssmin'
	]);

	grunt.registerTask('build', [
		'shell',
		'htmlmin',
		'scripts',
		'styles'
	]);

	grunt.registerTask('default', [
		'shell',
		'scripts',
		'styles',
		'connect',
		'watch'
	]);

};
