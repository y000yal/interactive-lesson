const path = require('path');
const CopyPlugin = require("copy-webpack-plugin");
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const isProduction = process.env.NODE_ENV === 'production';
const WebpackBar = !isProduction ? require("webpackbar") : null;
module.exports = {
    entry: {
        blocks: "./src/blocks/index.js",
    },
    output: {
        path: path.resolve(__dirname + "/chunks"),
        publicPath: "/",
        filename: "[name].js",
        clean: true
    },
    resolve: {
        extensions: [".js", ".jsx", ".json"]
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@wordpress/babel-preset-default']
                    }
                }
            },
            {
                test: /\.scss$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader' // compiles Sass to CSS
                ]
            }
        ]
    },
    plugins: [
        new CopyPlugin({
            patterns: [
                {
                    from: "src/blocks/**/block.json",
                    to({ absoluteFilename }) {
                        return path.resolve(
                            __dirname,
                            "chunks",
                            path.basename(path.dirname(absoluteFilename)),
                            "block.json"
                        );
                    }
                }
            ]
        }),
        new MiniCssExtractPlugin({
            filename: "[name].css" // → will output chunks/blocks.css, etc.
        }),
        ...(!isProduction && WebpackBar ? [new WebpackBar()] : [])
    ],
    externals: {
        "@wordpress/blocks": ["wp", "blocks"],
        "@wordpress/components": ["wp", "components"],
        "@wordpress/block-editor": ["wp", "blockEditor"],
        "@wordpress/server-side-render": ["wp", "serverSideRender"],
        react: ["React"]
    }
};
