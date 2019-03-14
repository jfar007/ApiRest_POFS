const mix = require('laravel-mix');


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.scripts([
    'resources/assets/vue.js',
    'resources/assets/axios.js',
    'resources/js/app.js'
],'public/js/data.js');


  // .sass('resources/sass/app.scss', 'public/css');


//----------------Core----------------------------

mix.styles([
    'resources/assets/vendors/bootstrap/dist/css/bootstrap.min.css',
    'resources/assets/vendors/font-awesome/css/font-awesome.min.css',
    'resources/assets/vendors/nprogress/nprogress.css',
    'resources/assets/vendors/iCheck/skins/flat/green.css'

],'public/css/app.css');


mix.scripts([
    'resources/assets/vendors/jquery/dist/jquery.min.js',
    'resources/assets/vendors/bootstrap/dist/js/bootstrap.min.js',
    'resources/assets/vendors/fastclick/lib/fastclick.js',
    'resources/assets/vendors/nprogress/nprogress.js',
    'resources/assets/vendors/iCheck/icheck.min.js'],'public/js/app.js');


<!-- Custom Theme Style -->
mix.styles([
    'resources/assets/build/css/custom.min.css'
],'public/css/customTheme.css');

/*Custom Theme js*/
mix.scripts([
    'resources/assets/build/js/custom.min.js'
], 'public/js/customTheme.js');

mix.copy([
    'resources/assets/vendors/font-awesome/fonts'
], 'public/fonts');

//---------------General-------------------------------


//App General
mix.styles([
    'resources/assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
    'resources/assets/vendors/jqvmap/dist/jqvmap.min.css',
    'resources/assets/vendors/bootstrap-daterangepicker/daterangepicker.css'
], 'public/css/default.css');


mix.scripts([
    'resources/assets/vendors/Chart.js/dist/Chart.min.js',
    'resources/assets/vendors/gauge.js/dist/gauge.min.js',
    'resources/assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
    'resources/assets/vendors/iCheck/icheck.min.js',
    'resources/assets/vendors/skycons/skycons.js',
    'resources/assets/vendors/Flot/jquery.flot.js',
    'resources/assets/vendors/Flot/jquery.flot.pie.js',
    'resources/assets/vendors/Flot/jquery.flot.time.js',
    'resources/assets/vendors/Flot/jquery.flot.stack.js',
    'resources/assets/vendors/Flot/jquery.flot.resize.js',
    'resources/assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js',
    'resources/assets/vendors/flot-spline/js/jquery.flot.spline.min.js',
    'resources/assets/vendors/flot.curvedlines/curvedLines.js',
    'resources/assets/vendors/DateJS/build/date.js',
    'resources/assets/vendors/jqvmap/dist/jquery.vmap.js',
    'resources/assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js',
    'resources/assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js',
    'resources/assets/vendors/moment/min/moment.min.js',
    'resources/assets/vendors/bootstrap-daterangepicker/daterangepicker.js',
    'resources/assets/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js',
    'resources/assets/build/js/custom.min.js'
], 'public/js/default.js');



//Tables Dynamic
mix.styles([
    'resources/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
    'resources/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
    'resources/assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css',
    'resources/assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css',
    'resources/assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css'

], 'public/css/tableDynamic.css');


mix.scripts([
    'resources/assets/vendors/datatables.net/js/jquery.dataTables.min.js',
    'resources/assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
    'resources/assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js',
    'resources/assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
    'resources/assets/vendors/datatables.net-buttons/js/buttons.flash.min.js',
    'resources/assets/vendors/datatables.net-buttons/js/buttons.html5.min.js',
    'resources/assets/vendors/datatables.net-buttons/js/buttons.print.min.js',
    'resources/assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js',
    'resources/assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js',
    'resources/assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js',
    'resources/assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js',
    'resources/assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js',
    'resources/assets/vendors/jszip/dist/jszip.min.js',
    'resources/assets/vendors/pdfmake/build/pdfmake.min.js',
    'resources/assets/vendors/pdfmake/build/vfs_fonts.js'

], 'public/js/tableDynamic.js');




