module.exports = function (grunt, options) {
    return {
        post_release: {
            options: {
                comment: "Release v" + options.pkg.version
            },
            files: {
                versions: options.release.versionFiles
            }
        }
    };
};