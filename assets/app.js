"use strict";
console.log("OK")

import '@fortawesome/fontawesome-free/css/all.min.css'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'
import 'https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'

import 'summernote/dist/summernote-bs4.css'
import './styles/style.css';
import './styles/components.css'
import './styles/custom.css';

/*import $ from 'jquery';
const jQuery = $
window.$ = window.jQuery = $;*/
import './js/stisla.js'

import 'popper.js'
import 'bootstrap';
import 'bootstrap-datepicker'
import 'bootstrap-datepicker/dist/locales/bootstrap-datepicker.ja.min.js'
import 'jquery.nicescroll'
import 'moment'
import 'summernote'
import 'https://cdn.jsdelivr.net/npm/summernote@0.8.20/src/lang/summernote-ja-JP.js'

import "https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"
import "https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"
$('table.table').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Japanese.json"
    },
    order: []
});

import './js/scripts.js'
import './js/custom.js'



$('.js-datepicker').datepicker({
    language:'ja',
});

$('.summernote').summernote({
    lang: 'ja-JP',
    height: 200,
});


//import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
//stislaデザイン用にコメントアウト
//import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
