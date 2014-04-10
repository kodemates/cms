require('./web/js/require-all.js');

module.exports = function(grunt) {

    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-bower-task');
    grunt.loadNpmTasks('grunt-contrib-concat');


    grunt.initConfig({
      /*************************************************************
       * Styling tasks: Foundation, Sass, css related tasks        *
       *************************************************************/
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


      /*************************************************************
       * Javascripts tasks: Concat and Minification                *
       *************************************************************/
      concat: {
          '.tmp/concat/js/app.js': __all_scripts
      },
      uglify: {
          'web/js/built-all.js': ['.tmp/concat/js/app.js']
      },


      /*************************************************************
       * Package Managers: Vendor installers                       *
       *************************************************************/
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

    grunt.registerTask('build', ['sass:main', 'copy:main']);
    grunt.registerTask('install', ['bower:install', 'build']);
    

    grunt.registerTask('default', ['build']);

};
