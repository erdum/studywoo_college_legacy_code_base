const mix = require("laravel-mix");
const ChunkRenamePlugin = require("webpack-chunk-rename-plugin");


mix.options({ processCssUrls: false });


mix.webpackConfig({
        output: {
            publicPath: "/admin-js/",
            filename: "[name].js",
            chunkFilename: "js/[name].js"
        },
        plugins: [
            new ChunkRenamePlugin({
                initialChunksWithEntry: true,
                "/js/vendor": "/js/vendor.js"
            })
        ]
    })
    .setResourceRoot("/admin-js")
    .setPublicPath("public/admin-js")
    .js("resources/js/global.init.js", "public/admin-js/js")
    .extract(["axios", 'sweetalert2'])

if (mix.inProduction()) {
    mix.version();
} else {
    mix.disableNotifications();
}