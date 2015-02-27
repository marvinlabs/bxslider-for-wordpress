module.exports = function (grunt, options) {

/*
    var additionalCommitFiles = [];
    var assetTypes = ["scripts", "styles"];

    for (var j=0; j<assetTypes.length; j++) {
        var config = options.assets[assetTypes[j]];

        var count = config.length;
        for (var i = 0; i < count; ++i) {
            var asset = config[i];
            var outputPath = asset.output.path + "/" + asset.output.file;

            additionalCommitFiles.push(outputPath);
        }
    }
*/

    "package.json",
        "readme.txt",
        "README.md",
        "bxslider-integration.php"

    return {
        options: {
        },
        plugin_file:{
            options: {
                prefix: "Version:\\s*"
            },
            src: [options.pkg.name + ".php"]
        },
        readme_txt:{
            options: {
                prefix: "Stable tag:\\s*"
            },
            src: ["readme.txt"]
        },
        package:{
            src: ["package.json"]
        }
    };
};