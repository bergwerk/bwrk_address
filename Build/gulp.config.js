const importPaths = require('./gulp.paths.js');
const path = importPaths.path;

const config = {
	minify: false
};

const files = {
	jsFilesLibUtility: [

	],

	jsFilesLibBabel: [

	],

	jsFilesLibNormal: [

	],

	jsFilesOwn: [
		path.toSrc + 'js/**/*.js'
	]
};

module.exports.config = config;
module.exports.files = files;


