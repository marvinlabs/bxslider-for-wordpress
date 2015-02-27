var pkg = require("./package.json");
module.exports = function (grunt) {
    // Load configuration
    var configOptions = loadConfig(grunt, {
        config: {
            src: "grunt/tasks/*"
        },
        pkg: grunt.file.readJSON("package.json")
    }, 'grunt/config');

    // Configure tasks
    var path = require("path");
    require("load-grunt-config")(grunt, {
        configPath: path.join(process.cwd(), "grunt/tasks"),
        init: true,
        data: configOptions,
        jitGrunt: {
            staticMappings: {
                "makepot": "grunt-wp-i18n",
                "addtextdomain": "grunt-wp-i18n",
                "bump-only": "grunt-bump",
                "bump-commit": "grunt-bump"
            }
        }
    });

    // Register some default grunt tasks
    grunt.registerTask("default", ["watch"]);
    grunt.registerTask("i18n", ["checktextdomain", "makepot"]);
    grunt.registerTask("dist", ["less:dist", "uglify:dist", "autoprefixer:dist", "i18n", "wp_readme_to_markdown"]);
    grunt.registerTask("dev", ["less:dev", "uglify:dev", "autoprefixer:dev"]);

    // The task to make a new release before deploying
    grunt.registerTask("release", "Release task", function (mode) {
        grunt.task.run(
            "checkpending",
            "bump-only:" + mode,
            "dist",
            "bump-commit",
            "compress:build");
    });
};

/**
 * Load configuration files and store them in an associative array
 * @param grunt The grunt object
 * @param config The configuration object
 * @param path The path where configuration JSON files are stored
 * @returns {{}}
 */
function loadConfig(grunt, config, path) {
    var glob = require('glob');
    glob.sync('*.json', {cwd: path}).forEach(function (filename) {
        var key = filename.replace(/\.json$/, '');
        config[key] = grunt.file.readJSON(path + '/' + filename);
    });

    return config;
}