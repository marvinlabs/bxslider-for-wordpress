module.exports = function (grunt, options) {
    var additionalCommitFiles = [];
    var assetTypes = ['scripts', 'styles'];

    for (var j=0; j<assetTypes.length; j++) {
        var config = options.assets[assetTypes[j]];

        var count = config.length;
        for (var i = 0; i < count; ++i) {
            var asset = config[i];
            var outputPath = asset.output.path + "/" + asset.output.file;

            additionalCommitFiles.push(outputPath);
        }
    }

    return {
        options: {
            files: options.release.versionFiles,
            updateConfigs: [],
            commit: true,
            commitMessage: "Release v%VERSION%",
            commitFiles: options.release.commitFiles.concat(additionalCommitFiles),
            createTag: false,
            tagName: "%VERSION%",
            tagMessage: "Version %VERSION%",
            push: true,
            pushTo: "origin",
            gitDescribeOptions: "--tags --always --abbrev=1 --dirty=-d",
            globalReplace: false,
            prereleaseName: false,
            regExp: false
        }
    };
};