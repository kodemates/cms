module.exports = function(grunt) {

    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-bower-task');


    grunt.initConfig({
      copy: {
        main: {
                files: [
                    // includes files within path and its sub-directories
                    {expand: true, flatten: true, filter: 'isFile', src: ['web/vendor/foundation/js/**'], dest: 'web/js/generated/'}
                ]
        }
      },
      sass: {
        main: {
            files: {
                'web/css/generated/normalize.css' :  'web/vendor/foundation/scss/normalize.scss',
                'web/css/generated/theme.css' : 'web/scss/theme.scss'
                //'web/css/generated/foundation.css' : 'vendor/zurb/foundation/scss/foundation.scss'
            }
        }
      },
      watch: {
        css: {
            files: 'scss/**/*.scss',
            tasks: ['sass']
        },
        tests: {
            files: [
                'js/**/*.js',
                'spec/**/*.js'
            ],
            tasks: 'test',
            options: {
                interrupt: true
            }
        }
      },
      bower: {
         install: {
            options: {
                targetDir: './web/vendors',
                install: true,
                verbose: true,
                cleanTargetDir: false,
                cleanBowerDir: false,
                bowerOptions: {}
            }
         }
      }
    });-

    grunt.registerTask('install', ['bower:install', 'build']);
    grunt.registerTask('build', ['sass:main', 'copy:main']);

    grunt.registerTask('default', ['build']);

};
