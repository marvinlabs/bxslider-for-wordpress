var pkg = require("./package.json");
module.exports = function (grunt) {
    // Load configuration
    var configOptions = loadConfig(grunt, {
        config: {
            src: "grunt/tasks/*"
        },
        pkg: grunt.file.readJSON("package.json")
    }, "grunt/config");

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
                "bump-commit": "grunt-bump",
                "replace": "grunt-text-replace",
                "gitcommit": "grunt-git"
            }
        }
    });

    // Register some default grunt tasks
    grunt.registerTask("default", ["watch"]);

    grunt.registerTask("dist", ["less:dist", "uglify:dist", "autoprefixer:dist", "tx-pull", "wp_readme_to_markdown"]);
    grunt.registerTask("dev", ["less:dev", "uglify:dev", "autoprefixer:dev"]);

    grunt.registerTask("tx-push", ["makepot", "exec:txpush_s"]);
    grunt.registerTask("tx-pull", ["exec:txpull", "potomo"]);

    // The task to prepare a new release
    grunt.registerTask("start-release", "Prepare release task", function (mode) {
        grunt.task.run(
            "checktextdomain",
            "checkpending",
            "version::" + mode,
            "tx-push",
            "dist");
    });

    // The task to make a new release
    grunt.registerTask("finish-release", "Release task", function (mode) {
        grunt.task.run(
            "gitcommit:post_release",
            "compress:build");
    });

    // Task to replace the path to images in the bxSlider CSS
    grunt.registerTask("update_libs", "Prepare the libraries", function (mode) {
        grunt.task.run("copy:bxslider_css", "replace:bxslider_css");
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
    var glob = require("glob");
    glob.sync("*.json", {cwd: path}).forEach(function (filename) {
        var key = filename.replace(/\.json$/, "");
        config[key] = grunt.file.readJSON(path + "/" + filename);
    });

    return config;
}