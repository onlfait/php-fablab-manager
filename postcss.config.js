const sass = require('@csstools/postcss-sass')
const postcssNormalize = require('postcss-normalize')
const autoprefixer = require('autoprefixer')

module.exports = {
  syntax: 'postcss-scss',
  plugins: [
    require('postcss-normalize'),
    require('@csstools/postcss-sass'),
    require('autoprefixer'),
    require('css-mqpacker'),
    require('cssnano')({
      preset: [
        'default', {
          normalizeWhitespace: false
        }
      ],
    })
  ]
}
