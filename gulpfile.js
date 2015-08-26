var elixir = require('laravel-elixir');

elixir(function (mix) {

 mix.sass([
     '../bower_components/bootstrap-sass/assets/stylesheets/bootstrap.scss'
  //'app.scss', // this is file where I @import all vendor styles and my own styles
 ]);
 /* backend */
 mix.styles([
  "custom_backend.css",
  "../bower_components/datatables/media/css/jquery.dataTables.min.css",
  "../bower_components/morris.js/morris.css",
  "../bower_components/font-awesome/css/font-awesome.min.css",
  ], 'public/css/backend.css');
 /* frontend */
 mix.styles([
  "custom_frontend.css",
  "../bower_components/font-awesome/css/font-awesome.min.css",
  '../bower_components/bootstrap-material-design-sass/css-compiled/ripples.css',
  '../bower_components/bootstrap-material-design-sass/css-compiled/material-wfont.css',
  '../bower_components/bootstrap-material-design-sass/icons/icons-material-design.css',
     /* Full Color for material design */
  '../bower_components/bootstrap-material-design/dist/css/material-fullpalette.min.css',
  '../bower_components/bootstrap-social/bootstrap-social.css',
 ], 'public/css/frontend.css');

 mix.scripts([
  'bower_components/jquery/dist/jquery.js',
  /* Jquery Session */
  'bower_components/jquery.cookie/jquery.cookie.js',
  /* Bootstrap Sass */
  'bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js',
  /* DataTables jquery plugin - includes search and filtering tables */
  "bower_components/datatables/media/js/jquery.dataTables.min.js",
  /*enable responsive web designs in browsers*/
  'bower_components/respond/dest/respond.min.js',
  /*write conditional JavaScript and CSS to handle each situation, whether a browser supports a feature or not*/
  "bower_components/modernizr/modernizr.js",
  /*charts*/
  "bower_components/morris.js/morris.min.js",
  /* Theme for material design */
  "bower_components/bootstrap-material-design-sass/scripts/material.js",
  "bower_components/bootstrap-material-design-sass/scripts/ripples.js",
  /*"bower_components/fineuploader-dist/dist/jquery.fine-uploader.min.js",*/
 ], 'public/js/app.js', 'resources/assets/', './');

 mix.version([
  'public/css/frontend.css',
  'public/css/backend.css',
  'public/js/app.js'
 ]);

});