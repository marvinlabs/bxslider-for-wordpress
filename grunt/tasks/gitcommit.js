module.exports = function (grunt, options) {
    var assetFiles = [];

    var configs = [options.assets.styles, options.assets.scripts];
    for (var j = 0; j < configs.count; ++j) {
        var config = configs[j];
        for (var i = 0; i < config.length; ++i) {
            var filter = config[i].output.path + "/*.css";
            assetFiles.push(filter);
        }
    }

    return {
        post_release: {
            options: {
                message: "Preparing release v" + options.pkg.version
            },
            files: {
                versions: options.release.versionFiles,
                assets: assetFiles,
                lang: [options.i18n.poPath + "/**"]
            }
        }
    };
};