module.exports = function (grunt, options) {
    return {
        target: {
            options: {
                cwd: '',                          // Directory of files to internationalize.
                domainPath: options.i18n.poPath,
                exclude: [
                    "node_modules/*",
                    "libs/*",
                    "grunt/*",
                    "assets/*"
                ],
                include: options.i18n.sources,
                i18nToolsPath: options.i18n.toolsPath,
                mainFile: options.i18n.mainFile,
                potComments: options.i18n.copyright,
                potFilename: options.i18n.textDomain + '.pot',
                potHeaders: {
                    poedit: true,
                    'x-poedit-keywordslist': true
                },
                processPot: null,
                type: options.i18n.projectType,
                updateTimestamp: true,
                updatePoFiles: true
            }
        }
    };
};