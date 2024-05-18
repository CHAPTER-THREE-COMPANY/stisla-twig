"use strict";
console.log("OK")

import '@fortawesome/fontawesome-free/css/all.min.css'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'
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
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
