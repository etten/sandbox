module.exports = function (grunt) {
	var lessFiles = {
		'web/css/style.css': 'web/css/style.less'
	};

	var tsSrc = [
		'web/js/**/*.ts'
	];

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		less: {
			development: {
				options: {
					paths: [
						'web/css'
					],
					relativeUrls: true,
					sourceMap: true
				},
				files: lessFiles
			},
			production: {
				options: {
					paths: [
						'web/css'
					],
					relativeUrls: true
				},
				files: lessFiles
			}
		},
		ts: {
			development: {
				options: {
					newLine: 'LF',
					sourceMap: true
				},
				src: tsSrc
			},
			production: {
				options: {
					newLine: 'LF'
				},
				src: tsSrc
			}
		},
		watch: {
			less: {
				files: [
					'www/**/*.less'
				],
				tasks: ['less:development']
			},
			ts: {
				files: [
					'www/**/*.ts'
				],
				tasks: ['ts:development']
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-ts');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('development', ['less:development', 'ts:development']);
	grunt.registerTask('production', ['less:production', 'ts:production']);
};
