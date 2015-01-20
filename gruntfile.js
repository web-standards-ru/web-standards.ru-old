module.exports = function(grunt) {

	require('load-grunt-tasks')(grunt);

	grunt.initConfig({

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
		}

	});

	grunt.registerTask('default', [
		'htmlmin',
		'autoprefixer',
		'cssmin'
	]);

};
