const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles(
    [
        "resources/plantilla/css/all.min.css",
        "resources/plantilla/css/ionicons.min.css",
        "resources/plantilla/css/adminlte.min.css",
        "resources/plantilla/css/OverlayScrollbars.min.css",
        "resources/plantilla/css/themify-icons.css"
    ],
    "public/css/plantilla.css"
)
    .scripts(
        [
            "resources/plantilla/js/jquery.min.js",
            "resources/plantilla/js/bootstrap.bundle.min.js",
            "resources/plantilla/js/Chart.min.js",
            "resources/plantilla/js/jquery.overlayScrollbars.min.js",
            "resources/plantilla/js/adminlte.js"
        ],
        "public/js/plantilla.js"
    )
    .js(["resources/js/app.js"], "public/js/app.js");

