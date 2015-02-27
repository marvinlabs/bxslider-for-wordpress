module.exports = function (grunt, options) {
    return {
        "options" : {
            "screenshot_url": "http://plugins.svn.wordpress.org/{plugin}/assets/{screenshot}.jpg"
        },
        all: {
            files: {
                'README.md': 'readme.txt'
            }
        }
    };
};