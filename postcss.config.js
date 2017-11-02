module.exports = {
    plugins: [
        require('precss'),
        require('autoprefixer'),
		require('postcss-sorting')({
			"properties-order": "alphabetical"
		}),
		require('cssnano')({preset: 'default',})
    ]
}
