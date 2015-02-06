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
					port: 0,
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

	grunt.registerTask('styles', [
		'sass',
		'autoprefixer'
	]);

	grunt.registerTask('build', [
		'styles',
		'shell',
		'htmlmin',
		'cssmin'
	]);

	grunt.registerTask('default', [
		'styles',
		'shell',
		'connect',
		'watch'
	]);

};
