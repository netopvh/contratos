var elixir = require('laravel-elixir');

elixir.config.sourcemaps = false;

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {

    //Performs the copy of files to a public folder
    mix.copy('resources/assets/bower_components/font-awesome/fonts','public/build/fonts');
    mix.copy('resources/assets/bower_components/Ionicons/fonts','public/build/fonts');
    mix.copy('resources/assets/bower_components/AdminLTE/bootstrap/fonts','public/build/fonts');
    mix.copy('resources/assets/bower_components/AdminLTE/plugins','public/plugins');
    mix.copy('resources/assets/bower_components/jquery-validation','public/plugins/jquery-validation');
    mix.copy('resources/assets/bower_components/jquery-treegrid','public/plugins/jquery-treegrid');
    mix.copy('resources/assets/bower_components/jquery.inputmask','public/plugins/jquery.inputmask');
    mix.copy('resources/assets/bower_components/jquery-maskmoney','public/plugins/jquery-maskmoney');

    //Default files for theme AdminLTE
    mix.styles([
        'bower_components/AdminLTE/bootstrap/css/bootstrap.css',
        'bower_components/font-awesome/css/font-awesome.css',
        'bower_components/Ionicons/css/ionicons.css',
        'bower_components/AdminLTE/dist/css/AdminLTE.css'
    ], 'public/css/default.css', 'resources/assets');

    //Files to modification style from theme
    mix.styles([
        'css/default.css'
    ], 'public/css/custom.css', 'resources/assets');

    //Default files for scrits AdminLTE
    mix.scripts([
        'bower_components/jquery/dist/jquery.js',
        'bower_components/AdminLTE/bootstrap/js/bootstrap.js'
    ], 'public/js/default.js', 'resources/assets');

    //Files to modification scripts from theme
    mix.scripts([
        'bower_components/AdminLTE/dist/js/app.js',
        'js/default.js'
    ],'public/js/app.js','resources/assets');

    mix.version([
        'public/css/default.css',
        'public/css/custom.css',
        'public/js/default.js',
        'public/js/app.js'
    ]);

});
