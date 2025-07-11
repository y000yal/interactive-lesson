module.exports = function (grunt) {
    grunt.initConfig({
        sass: {
            dist: {
                options: {
                    implementation: require('sass'),
                    sourceMap: false
                },
                files: {
                    'assets/css/style.css': 'assets/css/style.scss'
                }
            }
        },
        watch: {
            styles: {
                files: ['assets/css/**/*.scss'],
                tasks: ['sass'],
                options: { spawn: false }
            }
        }
    });

    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['sass']);
    grunt.registerTask('dev', ['sass', 'watch']);
};
