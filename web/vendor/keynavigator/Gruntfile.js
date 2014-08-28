module.exports = function(grunt) {
  'use strict';

  /*
   * From jQuery build: 
   *    https://github.com/jquery/jquery/blob/master/build/tasks/build.js
   * 
   *  Special concat/build task to handle various jQuery build requirements
   *  Concats AMD modules, removes their definitions, and includes/excludes specified modules
   */
  function convert( name, path, contents ) {
    var rdefineEnd = /\}\);[^}\w]*$/;
    // Convert var modules
    if ( /.\/var\//.test( path ) ) {
      contents = contents
        .replace( /define\([\w\W]*?return/, "var " + (/var\/([\w-]+)/.exec(name)[1]) + " =" )
        .replace( rdefineEnd, "" );

    } else {

      // Ignore jQuery's return statement (the only necessary one)
      if ( name !== "jquery" ) {
        contents = contents
          .replace( /\s*return\s+[^\}]+(\}\);[^\w\}]*)$/, "$1" );
      }

      // Remove define wrappers, closure ends, and empty declarations
      contents = contents
        .replace( /define\([^{]*?{/, "" )
        .replace( rdefineEnd, "" );

      // Remove CommonJS-style require calls
      // Keep an ending semicolon
      contents = contents
        .replace( /(\s+\w+ = )?\s*require\(\s*(")[\w\.\/]+\2\s*\)([,;])/g,
          function( all, isVar, quote, commaSemicolon ) {
            return isVar && commaSemicolon === ";" ? ";" : "";
          });

      // Remove empty definitions
      contents = contents
        .replace( /define\(\[[^\]]+\]\)[\W\n]+$/, "" );
    }

    return contents;
  }

 /*
  * Build options
  *
  */

  // Dev build
  var buildOptions = {
    baseUrl: 'src',
    paths: {
      'jquery': 'empty:'
    },
    skipModuleInsertion: true,
    findNestedDependencies: true,
    rawText: {},
    onBuildWrite: convert,
    include: [
      'Keynavigator.js',
      'Keymappings',
      'Cellfactory.js',
      'Celltable.js'
    ],
    out: 'keynavigator.js',
    optimize: 'none',
    wrap: {
      startFile: 'wrap/start.frag',
      endFile: 'wrap/end.frag'
    }
  };

  // Grunt configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // Tests with Jasmine.
    jasmine: {
      task: {
        src: 'src/*.js',
        options: {
          specs: 'test/*spec.js',
          template: require('grunt-template-jasmine-requirejs'),
          templateOptions: {
            requireConfig: {
              paths: {
                'jquery': 'vendor/jquery'
              }
            }
          }
        }
      }
    },

    //JSHint options
    jshint: {
      files: ['src/*.js'],
      options: {
        curly: true,
        // Strict equal (===) is not mandatory.
        eqeqeq: false,
        undef: true,
        // We are running in a browser.
        browser: true,
        // Ignore "expected an assignment or 
        // function call and instead saw an expression."
        '-W030': false,
        eqnull: true,
        globals: {
          define: true
        }
      }
    },

    //Watch - run "tasks" when a src/*.js file is modified.
    watch: {
      scripts: {
        files: ['src/*.js'],
        tasks: ['jshint'],
        options: {
          spawn: false,
        }
      }
    },

    // RequireJS with build task.
    requirejs: {
      build: {
        options: buildOptions
      }
    },

    // Uglify
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> v.<%= pkg.version %> - ' +
                'build <%= grunt.template.today("isoDateTime") %> */\n'
      },
      dist: {
        files: {
          'keynavigator-min.js': ['keynavigator.js']
        }
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-jasmine');
  grunt.loadNpmTasks('grunt-contrib-requirejs');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  
  grunt.registerTask('default', [
    'requirejs:build',
    'jasmine',
    'jshint',
    'uglify'
  ]);
};
