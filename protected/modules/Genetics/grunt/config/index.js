module.exports = function(grunt) {
	return {
		pkg: grunt.file.readJSON('package.json'),
		compass: require('./compass')(grunt),
		watch: require('./watch')(grunt)
	};
};