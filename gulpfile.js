var elixir = require('laravel-elixir');

elixir(function (mix) {

 mix.sass([
     /* sass folder */
  '../bower_components/bootstrap-sass/assets/stylesheets/bootstrap.scss',
  '../bower_components/normalize.scss/_normalize.scss',
  //'app.scss', // this is file where I @import all vendor styles and my own styles
 ]);

 /* Abstract CSS for All Application  */
 mix.styles([
  "custom_frontend.css",
  "../bower_components/font-awesome/css/font-awesome.min.css",
  '../bower_components/bootstrap-social/bootstrap-social.css',
  "../bower_components/AdminLTE/plugins/iCheck/flat/blue.css",
  /*"../bower_components/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css",*/
  "../bower_components/AdminLTE/plugins/datepicker/datepicker3.css",
  "../bower_components/AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css",
  "../bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css",
  "../bower_components/AdminLTE/plugins/datepicker/datepicker3.css",
  "../bower_components/AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css",
  "../bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css",

  "ionicons.min.css"
 ], 'public/css/abstract-css.css');

 /* backend */
 mix.styles([
  "custom_backend.css",
  //"sb-admin-2.css",
  //"style.css",
  "../bower_components/AdminLTE/dist/css/AdminLTE.min.css",
  "../bower_components/AdminLTE/dist/css/skins/_all-skins.min.css",
  "../bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.css",
  "../bower_components/morris.js/morris.css",
  "../bower_components/font-awesome/css/font-awesome.min.css",
  ], 'public/css/backend.css');
 /* frontend */
 mix.styles([
  "custom_frontend.css",

 ], 'public/css/frontend.css');
 /* material Design */
 mix.styles([
  '../bower_components/bootstrap-material-design-sass/css-compiled/ripples.css',
  '../bower_components/bootstrap-material-design-sass/css-compiled/material-wfont.css',
  '../bower_components/bootstrap-material-design-sass/icons/icons-material-design.css',
  /* Full Color for material design */
  '../bower_components/bootstrap-material-design/dist/css/material-fullpalette.min.css',
 ], 'public/css/material-design.css');
 // Javascripts for all application
 mix.scripts([

  'bower_components/AdminLTE/plugins/JQuery/jQuery-2.1.4.min.js',
  'bower_components/AdminLTE/plugins/JQueryUI/jquery-ui.min.js',
  /* Jquery Session */
  'bower_components/jquery.cookie/jquery.cookie.js',
  /* Bootstrap Sass */
  'bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js',
  /* DataTables jquery plugin - includes search and filtering tables */
  "bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js",
  /*enable responsive web designs in browsers*/
  'bower_components/respond/dest/respond.min.js',
  /*write conditional JavaScript and CSS to handle each situation, whether a browser supports a feature or not*/
  "bower_components/modernizr/modernizr.js",
  /*charts*/
  "bower_components/morris.js/morris.min.js",
  /* Theme for material design */
  "bower_components/bootstrap-material-design-sass/scripts/material.js",
  "bower_components/bootstrap-material-design-sass/scripts/ripples.js",


  // raphael -- for graphic widgets
  "bower_components/raphael/raphael-min.js",
     // this points that showes on graphs - sparkline
  "bower_components/AdminLTE/plugins/sparkline/jquery.sparkline.min.js",
    // rounded circle for graphs
  "bower_components/AdminLTE/plugins/knob/jquery.knob.js",

  "bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.js",
  "bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js",
  "bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js",
  "bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js",
  "bower_components/AdminLTE/plugins/fastclick/fastclick.min.js",

   // Javascript Clock
   "js/moment.min.js",


   /*"js/abstract-js.js"*/
  /*"bower_components/fineuploader-dist/dist/jquery.fine-uploader.min.js",*/
 ], 'public/js/app.js', 'resources/assets/', './');
 mix.version([
  'public/css/frontend.css',
  'public/css/backend.css',
  'public/css/abstract-css.css',
  'public/js/app.js'
 ]);

});