module.exports = function (grunt, options) {
    return {
        pre_release: {
            options: {
                branch: 'release/' + options.pkg.version
            }
        }
    };
};