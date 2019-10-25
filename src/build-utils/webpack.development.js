const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const FileManagerPlugin = require('filemanager-webpack-plugin');

module.exports = () => ({

    module: {
        rules: [
            {
                test: /\.s?css$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            url: false,
                            publicPath: '../'
                        }
                    },
                    'css-loader',
                    'sass-loader'
                ]
            },
            {
                test: /\.(jpe?g|png|gif|ttf|eot|svg|woff)$/,
                loader: 'file-loader',
                options: {
                    name: 'images/[name].[ext]'
                }
            },
            {
                test: /\.js$/,
                use: 'babel-loader',
                exclude: '/node_modules/',
            }
        ]
    },

    plugins: [
        new FileManagerPlugin({

            onEnd: {
                copy: [
                    {
                        source: './src/vendor/particles.min.js',
                        destination: './assets/js/particles.min.js'
                    }
                ]
            }
        })
    ]

});