const path = require('path');

module.exports = {
    entry: './src/media.js',
    output: {
        filename: 'media.js',
        path: path.resolve(__dirname, 'js')
    }
};

module.exports = {
    entry: './src/swiper.js',
    output: {
        filename: 'swiper.js',
        path: path.resolve(__dirname, 'js')
    }
};