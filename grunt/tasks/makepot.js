function objToString(obj, level) {
    var out = '';
    for (var i in obj) {
        for (loop = level; loop > 0; loop--) {
            out += "    ";
        }
        if (obj[i] instanceof Object) {
            out += i + " (Object):\n";
            out += objToString(obj[i], level + 1);
        }
        else {
            out += i + ": " + obj[i] + "\n";
        }
    }
    return out;
}

module.exports = function (grunt, options) {
    return {
        default: {
            options: {
                cwd: '',                          // Directory of files to internationalize.
                domainPath: options.i18n.poPath,
                exclude: [
                    "node_modules/.*",
                    "libs/.*",
                    "grunt/.*",
                    "assets/.*"
                ],
                include: options.i18n.sources,
                mainFile: options.i18n.mainFile,
                potComments: options.i18n.copyright,
                potFilename: options.i18n.textDomain + '.pot',
                potHeaders: {
                    poedit: true,
                    'x-poedit-keywordslist': true
                },
                processPot: function (pot) {
                    for (var translation in pot.translations['']) {
                        var tr = pot.translations[''][translation];

                        if ("" == translation.trim()) {
                            grunt.log.writeln("Removed empty string");
                            delete pot.translations[''][translation];
                            continue;
                        }

                        if (( 'undefined' !== typeof tr.comments.reference )
                            && (tr.comments.reference.indexOf("node_modules") >= 0)) {
                            grunt.log.writeln("Removed node_modules string: " + translation);
                            delete pot.translations[''][translation];
                            continue;
                        }
                    }
                    return pot;
                },
                type: options.i18n.projectType,
                updateTimestamp: true,
                updatePoFiles: true
            }
        }
    };
};