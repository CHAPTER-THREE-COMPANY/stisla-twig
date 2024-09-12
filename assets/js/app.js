// assets/js/app.js

console.log('Hello Webpack Encore');

//import('../css/app.css');

// loads the jquery package from node_modules
var $ = require('jquery');
window.$ = window.jQuery = $;
global.window.$ = global.window.jQuery = $;
global.$ = global.jQuery = $;

// import the function from greet.js (the .js extension is optional)
// ./ (or ../) means to look for a local file
//var greet = require('./greet');

/*$(document).ready(function() {
    $('body').prepend('<h1>'+greet('jill')+'</h1>');
    $('body').append("masaoikawa");
});*/

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
//require('stisla-dev/node_modules/jquery/dist/jquery.min');
require('bootstrap/dist/js/bootstrap.min');
require('nicescroll');
require('moment');
require('popper.js');
require('tooltip.js');
require('jquery-sparkline');
require('select2');
require('selectric');
require('codemirror');

require('cleave.js/dist/cleave');
require('cleave.js/dist/addons/cleave-phone.jp');
require('jquery-pwstrength/jquery.pwstrength.min');
require('bootstrap-datepicker/dist/js/bootstrap-datepicker.min');
require('bootstrap-datepicker/dist/locales/bootstrap-datepicker.ja.min');
require('bootstrap-daterangepicker/daterangepicker');
require('bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js');
require('bootstrap-timepicker/js/bootstrap-timepicker.min.js');
require('bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js');
require('summernote');
require('select2/dist/js/select2.full.min.js');
require('selectric/public/jquery.selectric.min.js');

require('simpleweather/jquery.simpleWeather.min.js');
require('chart.js/dist/Chart.min.js');
require('summernote/dist/summernote-bs4.min');
require('summernote/dist/lang/summernote-ja-JP.js');
// 2019/07/06 fullcalendarはminにすると不具合あり
require('fullcalendar/dist/fullcalendar');
require('fullcalendar/dist/locale-all');

//require('stisla-dev/assets/js/stisla');
//require('stisla-dev/assets/js/scripts');
require('./scripts');
require('./custom');

//require('jqvmap/dist/jquery.vmap.js');
//require('jqvmap/dist/maps/jquery.vmap.world.js');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

//$(document).ready(function() {
//    $('[data-toggle="popover"]').popover();
//});
//

require('../css/custom.css');
